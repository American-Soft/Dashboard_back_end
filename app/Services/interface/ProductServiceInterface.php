<?php 
namespace App\Services\interface;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;

interface ProductServiceInterface{
    public function index();
    public function store(StoreProductRequest $request , int $brandId);
    public function update(UpdateProductRequest $request, int $productId ,int $brandId);
    public function delete(int $productId);
}