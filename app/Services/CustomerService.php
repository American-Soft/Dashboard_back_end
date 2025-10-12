<?php 
namespace App\Services;

use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Models\Customer;
use App\Models\Request as ModelsRequest;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Services\interface\CustomerServiceInterface;

use function PHPUnit\Framework\isEmpty;

class CustomerService implements CustomerServiceInterface{

    public function __construct(protected CustomerRepositoryInterface $customerRepository){}

    public function store(StoreCustomerReqest $storeCustomerReqest , ModelsRequest $request){
        $customer = $this->customerRepository->create($storeCustomerReqest->toArray());
        $request->update(['customer_id' => $customer->id]);
        return ['data' => $customer , 'message' => 'Customer Request Stored Successfully' , 'status' => 201];
    }
    public function index(){
        $customers = $this->customerRepository->all();
        if($customers->isEmpty())
            return ['data' => null , 'message' => 'There is no Customer' , 'status' => 404];
        return ['data' => $customers , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(Customer $customer){
        //edit
        $customer->load('requests');
        return ['data' => $customer , 'message' => 'Customer Requests' , 'status' => 200];
    }

    public function delete(Customer $customer){
        $customer->delete();
        return ['data' => $customer, 'message' => 'Customer deleted', 'status' => 200];
    }

    public function update(UpdateCustomerReqest $request , Customer $customer){
        $data = array_filter($request->toArray(), function ($value) {
            return !is_null($value);
        });
        $changes = [];
        foreach ($data as $key => $value) {
            if ($customer->$key != $value) {
                $changes[$key] = $value;
            }
        }
        if (!empty($changes)) {
            $this->customerRepository->update($customer,$changes);
            return ['data' => $customer, 'message' => 'Customer updated successfully', 'status' => 200];
        }
        return ['data' => null, 'message' => 'No changes detected', 'status' => 200];
    }
}