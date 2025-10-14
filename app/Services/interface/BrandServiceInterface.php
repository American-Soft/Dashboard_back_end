<?php 
namespace App\Services\interface;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;

interface BrandServiceInterface{
    public function store(StoreBrandRequest $request);
    public function index();
    public function update(UpdateBrandRequest $request,int $brandId);
    public function delete(int $brandId);
}