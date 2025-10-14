<?php 
namespace App\Repositories\interface;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Request;

interface RequestRepositoryInterface{
    public function all();
    public function create(array $data , Brand $brand , Product $product);
    public function update(Request $request,array $data);
    public function delete(Request $request);
    public function show(Request $request);
    public function search(array $data);
    public function findById($id);
}