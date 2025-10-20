<?php 
namespace App\Services;

use App\Exceptions\CustomerNotFoundException;
use App\Exceptions\CustomersRequestsNotFoundException;
use App\Http\Requests\StoreCustomerReqest;
use App\Http\Requests\UpdateCustomerReqest;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Repositories\RequestRepository;
use App\Services\interface\CustomerServiceInterface;
use Exception;


class CustomerService implements CustomerServiceInterface{

    public function __construct(
        protected CustomerRepositoryInterface $customerRepository , 
        protected RequestRepository $requestRepository){}

    public function store(StoreCustomerReqest $storeCustomerRequest){
        $customer = $this->customerRepository->findByPhone($storeCustomerRequest->validated()['phone_number']);
        if($customer)
            return ['data' => $customer , 'message' => 'Customer Request Stored Successfully' , 'status' => 201];
        $customer = $this->customerRepository->create($storeCustomerRequest->validated());
        return ['data' => $customer , 'message' => 'Customer Request Stored Successfully' , 'status' => 201];
    }
    public function index(){
        $customers = $this->customerRepository->all();
        return ['data' => $customers , 'message' => 'Customers Requests' , 'status' => 200];
    }

    public function show(int $customerId){
        $customer = $this->customerRepository->show($customerId);
        return ['data' => $customer->load('requests') , 'message' => 'Customer Requests' , 'status' => 200];
    }

    public function delete(int $customerId){
        $customer = $this->customerRepository->findById($customerId);
        if(!$customer)
            Throw new CustomerNotFoundException();
        $customer->delete();
        return ['data' => $customer, 'message' => 'Customer deleted', 'status' => 200];
    }

    public function update(UpdateCustomerReqest $request , int $customerId){
        $customer = $this->customerRepository->findById($customerId);
        if(!$customer)
            Throw new CustomerNotFoundException();
        if($this->customerRepository->findByPhone($request->validated()['phone_number']) && $customer->phone_number != $request->validated()['phone_number']){
            throw new Exception('Phone number already exists');
        }
        $data = array_filter($request->validated(), function ($value) {
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