<?php 
namespace App\Services;

use App\Exceptions\BrandsNotFoundException;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Services\interface\BrandServiceInterface;

class BrandService implements BrandServiceInterface{


    public function __construct(protected BrandRepositoryInterface $brandRepository){}

    public function store(StoreBrandRequest $request){
        $brand = $this->brandRepository->create([
            'name' => $request->name,
        ]);
        return ['data' => $brand , 'message' => 'Brand Stored Successfully', 'status' => 200];
    }

    public function index(){
        $brands = $this->brandRepository->all();
        if($brands->isEmpty()) {
            throw new BrandsNotFoundException();
        }
        return ['data' => $brands , 'message' => 'Brands retrieved successfully', 'status' => 200];
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand = $this->brandRepository->update($brand,[
            'name' => $request->name,
        ]);
        return ['data' => $brand , 'message' => 'Brand updated successfully', 'status' => 200];
    }

    public function delete(Brand $brand)
    {
        $brand->delete();
        return ['data' => $brand , 'message' => 'Brand deleted successfully', 'status' => 200];
    }
}