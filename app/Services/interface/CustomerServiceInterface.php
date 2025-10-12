<?php 
namespace  App\Services\interface;

use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Models\Customer;
use App\Models\Request as ModelsRequest;

interface CustomerServiceInterface{
    public function store(StoreCustomerReqest $storeCustomerReqest , ModelsRequest $request);
    public function index();

    public function show(Customer $customer);

    public function delete(Customer $customer);

    public function update(UpdateCustomerReqest $request , Customer $customer);
}