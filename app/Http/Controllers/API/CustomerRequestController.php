<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\trait\ApiResponse;

class CustomerRequestController extends Controller
{
    use ApiResponse;
    public function store(StoreCustomerRequestRequest $request , Brand $brand , Product $product){
        $customer = Customer::create([
            'full_name' => $request['full_name'],
            'phone_number' => $request['phone_number'],
            'whatsapp_number' => $request['whatsapp_number'],
            'whatsapp_number_code' => $request['whatsapp_number_code'],
            'email' => $request['email'],
        ]);
        $request = ModelsRequest::create([
            'customer_id' => $customer->id,
            'brand_id' => $brand->id,
            'product_id' => $product->id,
            'city' => $request['city'],
            'governorate' => $request['governorate'],
            'region' => $request['region'],
            'address' => $request['address'],
            'status' => $request['status'],
            'problem_description' => $request['problem_description'],
            'warranty_status' => $request['warranty_status'],
            'note' => $request['note'],
            'domain' => $request['domain'],
        ]);
        $request->load('customer');
        return $this->successResponse($request , 'Request created successfully' , 201);
    }
}
