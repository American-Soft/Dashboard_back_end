<?php 
namespace  App\Services\interface;

use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Models\Customer;
use App\Models\Request as ModelsRequest;

interface CustomerServiceInterface{
    public function store(StoreCustomerReqest $storeCustomerReqest , int $requestId);
    public function index();

    public function show(int $customerId);

    public function delete(int $customerId);

    public function update(UpdateCustomerReqest $request , int $customerId);
}