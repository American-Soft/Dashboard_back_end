<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchCustomerRequestRequest;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Http\Requests\UpdateCustomerRequestRequest;
use App\Models\Brand;
use App\Models\CustomerRequest;
use App\Models\Product;
use App\Services\interface\CustomerRequestServiceInterface;
use App\trait\ApiResponse;

class CustomerRequestController extends Controller
{
    use ApiResponse;
    public function __construct(private CustomerRequestServiceInterface $customerRequestService)
    {}   

    public function store(StoreCustomerRequestRequest $request , Brand $brand, Product $product)
    {
        
        $result = $this->customerRequestService->store($request , $brand, $product);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function get_customer_request(CustomerRequest $customerrequest){
        $result = $this->customerRequestService->get_customer_request($customerrequest);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function customers_requests()
    {
        $result = $this->customerRequestService->customers_requests();
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function delete_customer_request(CustomerRequest $customerrequest)
    {
        $result = $this->customerRequestService->delete_customer_request($customerrequest);
        return $this->successResponse($result['data'],$result['message'],$result['status']);
    }

    public function search(SearchCustomerRequestRequest $request){
        $result = $this->customerRequestService->search($request);
        return $this->successResponse($result['data'],$result['message'],$result['status'] );
    }

    public function update(UpdateCustomerRequestRequest $request , CustomerRequest $customerRequest , Brand $brand , Product $product){
        $result = $this->update($request , $customerRequest , $brand , $product);
        return $this->successResponse($result,'Update Result Complete Successfully',200 );
    }
}
