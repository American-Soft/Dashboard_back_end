<?php 
namespace App\Services;

use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Services\interface\RequestServiceInterface;

use function PHPUnit\Framework\isEmpty;

class RequestService implements RequestServiceInterface{
    public function store(StoreRequestReqest $request , Brand $brand , Product $product){
        $req = ModelsRequest::create($request->toArray());
        return ['data'=>$req , 'message'=>'Request created successfully' , 'status'=>201];
    }

    public function index(){
        $requests = ModelsRequest::with('customer')->get();
        if($requests->isEmpty())
            return ['data' => null , 'message' => 'There is no request' , 'status' => 404];
        return ['data' => $requests , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(ModelsRequest $request){
        return ['data' =>  $request->load('customer') , 'message' => 'Customer Request' , 'status' => 200];
    }

    public function delete(ModelsRequest $request){
        $request->customer()->delete();
        return ['data' => null , 'message' => 'Delete Customer Request' , 'status' => 200];
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
            $request->update($changes);
            return ['data' => $request, 'message' => 'request updated successfully', 'status' => 200];
        }
        return ['data' => null , 'message' => 'No changes detected' , 'status' => 200];
    }

    public function search(SearchRequestReqest $request){
        $query = ModelsRequest::query();
        if(!empty($request->id)){
            $query->where('id',$request->id);
        }
        if($request->phone){
            $query->where('phone_number',$request->phone);
        }
        if($request->brand_name){
            $brand = Brand::where('name',$request->brand_name)->first();
            $query->where('brand_id',$brand->id);
        }
        if($request->status){
            $query->where('status',$request->status);
        }
        if($request->created_at){
            $query->whereDate('created_at',$request->created_at);
        }
        if($request->domain){
            $query->whereDate('domain',$request->domain);
        }
        if(isEmpty($request)){
            return ['data' => null , 'message' => 'Please provide at least one search parameter' , 'status' => 400];
        }
        if(isEmpty($query)){
            return ['data' => null , 'message' => 'No results found' , 'status' => 404];
        }
        $result = $query->get();
        return ['data' => $result , 'message' => 'Search Result' , 'status' => 200];
    }
}