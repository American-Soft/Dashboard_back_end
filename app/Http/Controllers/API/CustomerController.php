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

    public function store(StoreCustomerReqest $storeCustomerReqest , int $requestId){
        $result = $this->customerService->store($storeCustomerReqest , $requestId);
        return $this->successResponse($result['data'],$result['message'],   $result['status']);
    }
    public function index(){
        $customers = $this->customerService->index();
        return $this->successResponse($customers['data'],$customers['message'],   $customers['status']);
    }

    public function show(int $customerId){
        $customer = $this->customerService->show($customerId);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }

    public function delete(int $customerId){
        $customer = $this->customerService->delete($customerId);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }

    public function update(UpdateCustomerReqest $request , int $customerId){
        $customer = $this->customerService->update($request , $customerId);
        return $this->successResponse($customer['data'],$customer['message'],   $customer['status']);
    }
}
