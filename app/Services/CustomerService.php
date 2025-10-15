<?php 
namespace App\Services;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\CustomersRequestsNotFoundException;
use App\Exceptions\RequestNotFoundException;
use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Repositories\RequestRepository;
use App\Services\interface\CustomerServiceInterface;


class CustomerService implements CustomerServiceInterface{

    public function __construct(
        protected CustomerRepositoryInterface $customerRepository , 
        protected RequestRepository $requestRepository){}

    public function store(StoreCustomerReqest $storeCustomerRequest , int $requestiId){
        $request = $this->requestRepository->findById($requestiId);
        if(!$request)
            Throw new RequestNotFoundException();
        $customer = $this->customerRepository->create($storeCustomerRequest->toArray());
        $request->update(['customer_id' => $customer->id]);
        return ['data' => $customer , 'message' => 'Customer Request Stored Successfully' , 'status' => 201];
    }
    public function index(){
        $customers = $this->customerRepository->all();
        if($customers->isEmpty())
            Throw new CustomersRequestsNotFoundException();
        return ['data' => $customers , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(int $customerId){
        $customer = $this->customerRepository->show($customerId);
        return ['data' => $customer , 'message' => 'Customer Requests' , 'status' => 200];
    }

    public function delete(int $customerId){
        $customer = $this->customerRepository->findById($customerId);
        if(!$customer)
            Throw new CustomerNotFoundException();
        if($customer->id == 1){
            return ['data' => $customer, 'message' => 'you can not delete this customer', 'status' => 400];
        }
        $customer->delete();
        return ['data' => $customer, 'message' => 'Customer deleted', 'status' => 200];
    }

    public function update(UpdateCustomerReqest $request , int $customerId){
        $customer = $this->customerRepository->findById($customerId);
        if(!$customer)
            Throw new CustomerNotFoundException();
        if($customer->id == 1){
            return ['data' => $customer, 'message' => 'you can not Update this customer', 'status' => 400];
        }
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