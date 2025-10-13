<?php 
namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\interface\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface{
    public function __construct(protected Brand $brand){}

    public function all(){
        return $this->brand->withCount('requests')->get();
    }

    public function create(array $data){
        return $this->brand->create($data);
    }

    public function update(Brand $brand,array $data){
        $brand->update($data);
        return $brand->fresh();
    }

    public function findByName($name){
        return $this->brand->where('name' , $name)->first();
    }
}