<?php 
namespace App\Services\interface;

use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
interface RequestServiceInterface{
    public function index();
    public function show(int $requestId);
    public function delete(int $requestId);
    public function update(UpdateRequestReqest $updateRequest,int $requestId, int $brandId , int $productId);
    public function search(SearchRequestReqest $request);
}