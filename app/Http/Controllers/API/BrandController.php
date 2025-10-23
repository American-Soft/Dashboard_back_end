<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\interface\BrandServiceInterface;
use App\trait\ApiResponse;

class BrandController extends Controller
{
    use ApiResponse;

    public function __construct(private BrandServiceInterface $brandServiceInterface){}

    public function store(StoreBrandRequest $request)
    {
        $result =$this->brandServiceInterface->store($request);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }

    public function index()
    {
        $result =$this->brandServiceInterface->index();
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }

    public function show(int $brandId){
        $result = $this->brandServiceInterface->show($brandId);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }

    public function update(UpdateBrandRequest $request,int $brandId)
    {
        $result =$this->brandServiceInterface->update($request , $brandId);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }
    public function delete(int $brandId)
    {
        $result =$this->brandServiceInterface->delete($brandId);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }
}
