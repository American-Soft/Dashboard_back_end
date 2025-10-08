<?php 
namespace App\Services\interface;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;

interface ProductServiceInterface{
    public function index();
    public function store(StoreProductRequest $request , Brand $brand);
    public function update(UpdateProductRequest $request, Product $product ,Brand $brand);
    public function delete(Product $product);
}