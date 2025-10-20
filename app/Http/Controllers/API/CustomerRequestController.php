<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Services\interface\CustomerRequestServiceInterface;
use App\trait\ApiResponse;

class CustomerRequestController extends Controller
{
    use ApiResponse;
    public function __construct(protected CustomerRequestServiceInterface $customerRequestService){}
    public function store(StoreCustomerRequestRequest $request , int $brandId , int $productId){
        $result = $this->customerRequestService->store($request , $brandId , $productId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
}
