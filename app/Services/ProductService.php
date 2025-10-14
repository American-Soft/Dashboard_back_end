<?php 
namespace App\Services;

use App\Exceptions\BrandNotFoundException;
use App\Exceptions\ProductNotFoundException;
use App\Exceptions\ProductsNotFoundException;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Services\interface\ProductServiceInterface;
use Exception;

class ProductService implements ProductServiceInterface{


    public function __construct(protected ProductRepositoryInterface $productRepository , protected BrandRepositoryInterface $brandRepository){}

    public function index(){
        $products = $this->productRepository->all();
        

        if($products->isEmpty()) {
            throw new ProductsNotFoundException();
        }
        return ['data' => $products , 'message' => 'Products retrieved successfully' , 'status' => 200];
    }

    public function store(StoreProductRequest $request , int $brandId){
        $brand = $this->brandRepository->findById($brandId);
        if(!$brand) {
            throw new BrandNotFoundException();
        }
        $product = $this->productRepository->store([
            'name' => $request->name,
            'brand_id' => $brand->id,
        ]);
        return ['data' => $product , 'message' => 'Product created successfully' , 'status' => 201];
    }

    public function update(UpdateProductRequest $request, int $productId ,int $brandId){
        $brand = $this->brandRepository->findById($brandId);
        if(!$brand) {
            throw new BrandNotFoundException();
        }
        $product = $this->productRepository->findById($productId);
        if(!$product) {
            throw new ProductNotFoundException();
        }
        if($brand->id != $product->brand_id) {
            throw new Exception('Brand and product does not match');
        }
        $product = $this->productRepository->update([
            'name' => $request->name,
            'brand_id' => $brand->id,
        ] , $product);
        return ['data' => $product , 'message' => 'Product updated successfully' , 'status' => 200];
    }
    public function delete(int $productId)
    {
        $product = $this->productRepository->findById($productId);
        if(!$product) {
            throw new ProductNotFoundException();
        }
        $product->delete();
        return ['data' => $product , 'message' => 'Product deleted successfully' , 'status' => 200];
    }
}