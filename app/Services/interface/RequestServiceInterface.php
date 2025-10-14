<?php 
namespace App\Services\interface;

use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Request as ModelsRequest;

interface RequestServiceInterface{
    public function store(StoreRequestReqest $request , int $brandId , int $productId);
    public function index();
    public function show(int $requestId);
    public function delete(int $requestId);
    public function update(UpdateRequestReqest $updateRequest,int $requestId, int $brandId , int $productId);
    public function search(SearchRequestReqest $request);
}