<?php 
namespace App\Services\interface;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
interface BrandServiceInterface{
    public function store(StoreBrandRequest $request);
    public function index();
    public function show(int $brandId);
    public function update(UpdateBrandRequest $request,int $brandId);
    public function delete(int $brandId);
}