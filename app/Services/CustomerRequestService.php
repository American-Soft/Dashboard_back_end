<?php 
namespace App\Services;

use App\Exceptions\BrandNotFoundException;
use App\Exceptions\BrandRelationProductsException;
use App\Exceptions\ProductNotFoundException;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Notifications\CustomerRequestNotification;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Repositories\interface\RequestRepositoryInterface;
use App\Repositories\interface\UserRepositoryInterface;
use App\Services\interface\CustomerRequestServiceInterface;
use Illuminate\Support\Facades\Notification;

class CustomerRequestService implements CustomerRequestServiceInterface{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository , 
        protected RequestRepositoryInterface $requestRepository ,
        protected BrandRepositoryInterface $brandRepository , 
        protected ProductRepositoryInterface $productRepository,
        protected UserRepositoryInterface $userRepository){}
    public function store(StoreCustomerRequestRequest $request , int $brandId , int $productId){
        $brand = $this->brandRepository->findById($brandId);
        if(!$brand){
            throw new BrandNotFoundException();
        }
        $product = $this->productRepository->findById($productId);
        if(!$product){
            throw new ProductNotFoundException();
        }
        if($brand->id != $product->brand_id){
            throw new BrandRelationProductsException();
        }
        $customer = $this->customerRepository->findByPhone($request->validated()['phone_number']);
        if($customer){  
            $request = $this->requestRepository->store([
            'customer_id' => $customer->id,
            'brand_id' => $brand->id,
            'product_id' => $product->id,
            'city' => $request['city'],
            'governorate' => $request['governorate'],
            'region' => $request['region'],
            'address' => $request['address_order'],
            'status' => $request['status'],
            'problem_description' => $request['problem_description'],
            'warranty_status' => $request['warranty_status'],
            'note' => ['customer_note' => $request['note']],
            'domain' => $request['domain'],
            ]);
            $users = $this->userRepository->all();
            Notification::send($users, new CustomerRequestNotification($request->domain , $request->id));
            return ['data' => $request->load('customer') , 'message' => 'Request created successfully' , 'status' => 201];
        }
        $customer = $this->customerRepository->create([
            
            'full_name' => $request['full_name'],
            'phone_number' => $request['phone_number'],
            'whatsapp_number' => $request['whatsapp_number'],
            'whatsapp_number_code' => $request['whatsapp_number_code'],
            'email' => $request['email'],
            'address' => $request['address_customer'],
            
        ]);
        
        $request = $this->requestRepository->store([
            'customer_id' => $customer->id,
            'brand_id' => $brand->id,
            'product_id' => $product->id,
            'city' => $request['city'],
            'governorate' => $request['governorate'],
            'region' => $request['region'],
            'address' => $request['address_order'],
            'status' => $request['status'],
            'problem_description' => $request['problem_description'],
            'warranty_status' => $request['warranty_status'],
            'note' => [
                'customer_note' => $request['customer_note'],
            ],
            'domain' => $request['domain'],
        ]);
        $users = $this->userRepository->all();
        Notification::send($users, new CustomerRequestNotification($request->domain , $request->id));
        return ['data' => $request->load('customer') , 'message' => 'Request created successfully' , 'status' => 201];
    }

}