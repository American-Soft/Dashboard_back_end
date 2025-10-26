<?php 
namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\interface\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface{
    public function __construct(protected Brand $brand){}

    public function all($perPage, $pageName = 'page'){
        return $this->brand->withCount('requests')->paginate($perPage,['*'],$pageName);
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

    public function findById(int $id){
        return $this->brand->where('id' , $id)->first();
    }
}