<?php 
namespace App\Repositories\interface;

use App\Models\Product;

interface ProductRepositoryInterface{
    public function all();

    public function store(array $data);
    public function update(array $data , Product $product);
    public function findById($id);
}