<?php 
namespace App\Services\interface;

use App\Http\Requests\StoreCustomerRequestRequest;

interface CustomerRequestServiceInterface{
    public function store(StoreCustomerRequestRequest $request , int $brandId , int $productId);
}