<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\interface\ProductServiceInterface;
use App\Trait\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(protected ProductServiceInterface $productServiceInterface){}
    public function index()
    {
        $result = $this->productServiceInterface->index();
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function store(StoreProductRequest $request , int $brandId)
    {
        $result = $this->productServiceInterface->store($request , $brandId);
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function update(UpdateProductRequest $request, int $productId ,int $brandId)
    {
        $result = $this->productServiceInterface->update($request ,$productId, $brandId );
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function delete(int $productId)
    {
        $result = $this->productServiceInterface->delete($productId );
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }
}
