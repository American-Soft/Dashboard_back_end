<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Services\interface\RequestServiceInterface;
use App\trait\ApiResponse;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    use ApiResponse;

    public function __construct(protected RequestServiceInterface $requestService){}
    public function store(StoreRequestReqest $request , Brand $brand , Product $product){
        
        $result = $this->requestService->store($request , $brand , $product);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function index(){
        $result = $this->requestService->index();
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function show(ModelsRequest $request){
        $result = $this->requestService->show($request);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function delete(ModelsRequest $request){
        $result = $this->requestService->delete($request);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }


    public function update(UpdateRequestReqest $updateRequest,ModelsRequest $request, Brand $brand , Product $product){
        $result = $this->requestService->update($updateRequest , $request , $brand , $product);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function search(SearchRequestReqest $request){
        $result = $this->requestService->search($request);
        return $this->successResponse($result , 'Search Result' , 200);
    }
}
