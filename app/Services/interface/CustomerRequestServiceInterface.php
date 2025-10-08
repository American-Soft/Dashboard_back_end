<?php 
namespace App\Services\interface;

use App\Http\Requests\SearchCustomerRequestRequest;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Http\Requests\UpdateCustomerRequestRequest;
use App\Models\Brand;
use App\Models\CustomerRequest;
use App\Models\Product;

interface CustomerRequestServiceInterface 
{
    public function store(StoreCustomerRequestRequest $request,Brand $brand, Product $product);
    public function customers_requests();
    public function delete_customer_request(CustomerRequest $customerrequest);

    public function search(SearchCustomerRequestRequest $request);
    public function update(UpdateCustomerRequestRequest $request , CustomerRequest $customerRequest , Brand $brand , Product $product);
    public function get_customer_request(CustomerRequest $customerRequest);
}