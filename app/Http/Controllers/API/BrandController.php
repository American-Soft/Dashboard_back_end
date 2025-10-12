<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
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

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $result =$this->brandServiceInterface->update($request , $brand);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }
    public function delete(Brand $brand)
    {
        $result =$this->brandServiceInterface->delete($brand);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }
}
