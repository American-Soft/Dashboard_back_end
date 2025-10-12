<?php 
namespace App\Services\interface;

use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Request as ModelsRequest;

interface RequestServiceInterface{
    public function store(StoreRequestReqest $request , Brand $brand , Product $product);
    public function index();
    public function show(ModelsRequest $request);
    public function delete(ModelsRequest $request);
    public function update(UpdateRequestReqest $updateRequest,ModelsRequest $request, Brand $brand , Product $product);
    public function search(SearchRequestReqest $request);
}