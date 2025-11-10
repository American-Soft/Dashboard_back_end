<?php 
namespace App\Services;

use App\Exceptions\BrandNotFoundException;
use App\Exceptions\BrandRelationProductsException;
use App\Exceptions\ProductNotFoundException;
use App\Exceptions\RequestNotFoundException;
use App\Exceptions\UpdateExcption;
use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Repositories\interface\RequestRepositoryInterface;
use App\Services\interface\RequestServiceInterface;


class RequestService implements RequestServiceInterface{

    public function __construct(
        protected RequestRepositoryInterface $requestRepository , 
        protected BrandRepositoryInterface $brandRepository , 
        protected ProductRepositoryInterface $productRepository){}

    public function index(){
        $requests = $this->requestRepository->all(15, 'request');
        return ['data' => $requests , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(int $requestId){
        $request = $this->requestRepository->findById($requestId);
        if(!$request)
            throw new RequestNotFoundException();
        return ['data' =>  $request , 'message' => 'Customer Request' , 'status' => 200];
    }

    public function delete(int $requestId){
        $request = $this->requestRepository->findById($requestId);
        if(!$request)
            throw new RequestNotFoundException();
        $this->requestRepository->delete($request);
        return ['data' => $request , 'message' => 'Delete Customer Request' , 'status' => 200];
    }


    public function update(UpdateRequestReqest $updateRequest,int $requestId, int $brandId , int $productId){
        $request = $this->requestRepository->findById($requestId);
        if(!$request)
            throw new RequestNotFoundException();
        $brand = $this->brandRepository->findById($brandId);
        if(!$brand)
            throw new BrandNotFoundException();
        $product = $this->productRepository->findById($productId);
        if(!$product)
            throw new ProductNotFoundException();
        if($brand->id != $product->brand_id){
            throw new BrandRelationProductsException();
        }
        $data = array_filter($updateRequest->validated(), function ($value) {
            return !is_null($value);
        });
        $changes = [];
        foreach ($data as $key => $value) 
            if ($request->$key != $value) 
                $changes[$key] = $value;
        if($request->brand_id != $brand->id)
            $changes['brand_id'] = $brand->id;
        if($request->product_id != $product->id)
            $changes['product_id'] = $product->id;
        $existingNote = $request->note ?? [];
        $newNoteData = [];
        if(isset($data['customer_service_note'])){
            if (isset($request->note['customer_service_note'])) {
                if ($request->note['customer_service_note'] != $data['customer_service_note']) {
                    $newNoteData['customer_service_note'] = $data['customer_service_note'];
                    $mergedNote = array_merge($existingNote, $newNoteData);
                    $changes['note'] = $mergedNote;
                }
            }
        }
        
        if (!empty($changes)) {
            $request = $this->requestRepository->update($request,$changes);
            return ['data' => $request->fresh(), 'message' => 'request updated successfully', 'status' => 200];
        }
        return throw new UpdateExcption();
    }

    public function search(SearchRequestReqest $request){
        $result = $this->requestRepository->search($request->validated());
        return ['data' => $result , 'message' => 'Search Result' , 'status' => 200];
    }
}