<?php 
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Request;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\RequestRepositoryInterface;

use function PHPUnit\Framework\isEmpty;

class RequestRepository implements RequestRepositoryInterface{
    public function __construct(protected Request $request , protected BrandRepositoryInterface $brandRepository){}

    public function all(){
        return $this->request->with('customer')->get();
    }
    public function create(array $data , Brand $brand , Product $product){
        $data['brand_id'] = $brand->id;
        $data['product_id'] = $product->id;
        $data['customer_id'] = 1;
        return $this->request->create($data);
    }

    public function update(Request $request,array $data){
        $request->update($data);
        return $request->fresh();
    }

    public function delete(Request $request){
        $request->delete();
        return $request->fresh();
    }

    public function show(Request $request){
        return $request->load('customer');
    }


    public function search(array $data){
        $query = $this->request->query()->with(['customer','brand','product']);
        return $query->where(function ($q) use ($data) {
            if ($data['id']) {
                $q->where('id', 'like', '%' . $data['id'] . '%');
            }
            if ($data['created_at']) {
                $q->Where('created_at', 'like', '%'.$data['created_at'].'%');
            }
            if ($data['status']) {
                $q->Where('status', 'like', '%' . $data['status'] . '%');
            }
            if ($data['domain']) {
                $q->Where('domain', 'like', '%' . $data['domain'] . '%');
            }
            if(array_key_exists('warranty_status', $data) && $data['warranty_status'] != null){ 
                $q->Where('warranty_status',  (int)$data['warranty_status']);
            }
            if ($data['brand_name']) {
                $q->WhereHas('brand', function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['brand_name'] . '%');
                });
            }
            if($data['product_name']) {
                $q->WhereHas('product', function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['product_name'] . '%');
                });
            }
            if ($data['phone']) {
                $q->WhereHas('customer', function ($q) use ($data) {
                    $q->where('phone_number', 'like', '%' . $data['phone'] . '%');
                });
            }
        })->get();
    }

    public function findById($id){
        return $this->request->with('customer')->where('id' , $id)->first();
    }

    public function store(array $data){
        return $this->request->create($data);
    }
}