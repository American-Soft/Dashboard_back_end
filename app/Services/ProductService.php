<?php 
namespace App\Services;

use App\Exceptions\ProductsNotFoundException;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Services\interface\ProductServiceInterface;

class ProductService implements ProductServiceInterface{


    public function __construct(protected ProductRepositoryInterface $productRepositoryInterface){}

    public function index(){
        $products = $this->productRepositoryInterface->all();
        

        if($products->isEmpty()) {
            throw new ProductsNotFoundException();
        }
        return ['data' => $products , 'message' => 'Products retrieved successfully' , 'status' => 200];
    }

    public function store(StoreProductRequest $request , Brand $brand){
        $product = $this->productRepositoryInterface->store([
            'name' => $request->name,
            'brand_id' => $brand->id,
        ]);
        return ['data' => $product , 'message' => 'Product created successfully' , 'status' => 201];
    }

    public function update(UpdateProductRequest $request, Product $product ,Brand $brand){
        $product = $this->productRepositoryInterface->update([
            'name' => $request->name,
            'brand_id' => $brand->id,
        ] , $product);
        return ['data' => $product , 'message' => 'Product updated successfully' , 'status' => 200];
    }
    public function delete(Product $product)
    {
        $product->delete();
        return ['data' => $product , 'message' => 'Product deleted successfully' , 'status' => 200];
    }
}