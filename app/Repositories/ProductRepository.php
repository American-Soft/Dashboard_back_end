<?php 
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface{
    public function __construct(protected Product $product){}
    public function all(){
        return $this->product->with('brand')->get();
    }

    public function store(array $data){
        return $this->product->create($data);
    }
    public function update(array $data , Product $product){
        $product->update($data);
        return $product->fresh();
    }
    public function findById($id){
        return $this->product->where('id' , $id)->first();
    }
}