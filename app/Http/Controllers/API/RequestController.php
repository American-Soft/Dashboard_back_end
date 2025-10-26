<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Services\interface\RequestServiceInterface;
use App\trait\ApiResponse;


class RequestController extends Controller
{
    use ApiResponse;

    public function __construct(protected RequestServiceInterface $requestService){}

    public function index(){
        $result = $this->requestService->index();
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function show(int $requestId){
        $result = $this->requestService->show($requestId);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function delete(int $requestId){
        $result = $this->requestService->delete($requestId);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }


    public function update(UpdateRequestReqest $updateRequest,int $requestId, int $brandId , int $productId){
        $result = $this->requestService->update($updateRequest , $requestId , $brandId , $productId);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function search(SearchRequestReqest $request){
        $result = $this->requestService->search($request);
        return $this->successResponse($result , 'Search Result' , 200);
    }
}
