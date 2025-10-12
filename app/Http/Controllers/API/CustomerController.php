<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Models\Customer;
use App\Models\Request as ModelsRequest;
use App\Services\interface\CustomerServiceInterface;
use App\trait\ApiResponse;

class CustomerController extends Controller
{
    use ApiResponse;

    public function __construct(protected CustomerServiceInterface $customerService){}

    public function store(StoreCustomerReqest $storeCustomerReqest , ModelsRequest $request){
        $result = $this->customerService->store($storeCustomerReqest , $request);
        return $this->successResponse($result['data'],$result['message'],   $result['status']);
    }
    public function index(){
        $customers = $this->customerService->index();
        return $this->successResponse($customers['data'],$customers['message'],   $customers['status']);
    }

    public function show(Customer $customer){
        $customer = $this->customerService->show($customer);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }

    public function delete(Customer $customer){
        $customer = $this->customerService->delete($customer);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }

    public function update(UpdateCustomerReqest $request , Customer $customer){
        $customer = $this->customerService->update($request , $customer);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }
}
