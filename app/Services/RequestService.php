<?php 
namespace App\Services;

use App\Exceptions\RequestsNotFoundExcption;
use App\Exceptions\UpdateExcption;
use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Repositories\interface\RequestRepositoryInterface;
use App\Services\interface\RequestServiceInterface;

use Exception;
use function PHPUnit\Framework\isEmpty;

class RequestService implements RequestServiceInterface{

    public function __construct(protected RequestRepositoryInterface $requestRepository){}

    public function store(StoreRequestReqest $request , Brand $brand , Product $product){
        if($brand->id != $product->brand_id){
            throw new Exception('Brand and product does not match');
        }
        $req = $this->requestRepository->create($request->toArray() , $brand , $product);
        return ['data'=>$req , 'message'=>'Request created successfully' , 'status'=>201];
    }

    public function index(){
        $requests = $this->requestRepository->all();
        if($requests->isEmpty())
            throw new RequestsNotFoundExcption();
        return ['data' => $requests , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(ModelsRequest $request){
        return ['data' =>  $this->requestRepository->show($request->id) , 'message' => 'Customer Request' , 'status' => 200];
    }

    public function delete(ModelsRequest $request){
        if($request->customer->id == 1)
            throw new Exception('You can not delete this request');
        $this->requestRepository->delete($request);
        return ['data' => $request , 'message' => 'Delete Customer Request' , 'status' => 200];
    }


    public function update(UpdateRequestReqest $updateRequest,ModelsRequest $request, Brand $brand , Product $product){
        $data = array_filter($updateRequest->toArray(), function ($value) {
            return !is_null($value);
        });
        $changes = [];
        foreach ($data as $key => $value) {
            if ($request->$key != $value) {
                $changes[$key] = $value;
            }
        }
        if (!empty($changes)) {
            $changes['brand_id'] = $brand->id;
            $changes['product_id'] = $product->id;
            $this->requestRepository->update($request,$changes);
            return ['data' => $request, 'message' => 'request updated successfully', 'status' => 200];
        }
        return throw new UpdateExcption();
    }

    public function search(SearchRequestReqest $request){
        $result = $this->requestRepository->search($request->toArray());
        return ['data' => $result , 'message' => 'Search Result' , 'status' => 200];
    }
}