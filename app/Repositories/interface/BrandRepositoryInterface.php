<?php 
namespace App\Repositories\interface;

use App\Models\Brand;

interface BrandRepositoryInterface{
    public function all();
    public function create(array $data);
    public function update(Brand $brand,array $data);

    public function findByName($name);
    public function findById(int $id);
}