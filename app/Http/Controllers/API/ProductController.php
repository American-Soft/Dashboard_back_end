<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Services\interface\ProductServiceInterface;
use App\trait\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(protected ProductServiceInterface $productServiceInterface){}
    public function index()
    {
        $result = $this->productServiceInterface->index();
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function store(StoreProductRequest $request , Brand $brand)
    {
        $result = $this->productServiceInterface->store($request , $brand);
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function update(UpdateProductRequest $request, Product $product ,Brand $brand)
    {
        $result = $this->productServiceInterface->update($request ,$product, $brand );
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }

    public function delete(Product $product)
    {
        $result = $this->productServiceInterface->delete($product );
        return $this->successResponse($result['data'],$result['message'], $result['status']);
    }
}
