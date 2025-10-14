<?php 
namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\interface\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(protected Customer $customer){}
    public function all()
    {
        return Customer::all();
    }

    public function create(array $data){
        return $this->customer->create($data);
    }

    public function update(Customer $customer,array $data){
        $customer->update($data);
        return $customer->fresh();
    }

    public function findById($id){
        return $this->customer->where('id' , $id)->first();
    }
}