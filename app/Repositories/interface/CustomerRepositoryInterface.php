<?php 
namespace App\Repositories\interface;

use App\Models\Customer;

interface CustomerRepositoryInterface{
    public function all();
    public function create(array $data);
    public function update(Customer $customer,array $data);
    public function findById($id);

    public function show(int $customerId);
}