<?php 
namespace App\Repositories;

use App\Models\Brand;
use App\Models\CustomerRequest;
use App\Models\Product;
use App\Repositories\interface\CustomerRequestRepositoryInterface;

class CustomerRequestRepository implements CustomerRequestRepositoryInterface{
    public function __construct(protected CustomerRequest $customerRequest){}
    public function create(array $data) {
        return $this->customerRequest->create($data);
    }

    public function all() {
        return $this->customerRequest->all();
    }
}