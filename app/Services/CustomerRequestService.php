<?php 
namespace App\Services;

use App\Exceptions\CustomersRequestsNotFoundException;
use App\Http\Requests\SearchCustomerRequestRequest;
use App\Http\Requests\StoreCustomerRequestRequest;
use App\Http\Requests\UpdateCustomerRequestRequest;
use App\Models\Brand;
use App\Models\CustomerRequest;
use App\Models\Product;
use App\Repositories\interface\CustomerRequestRepositoryInterface;
use App\Services\interface\CustomerRequestServiceInterface;

class CustomerRequestService implements CustomerRequestServiceInterface
{

    public function __construct(protected CustomerRequestRepositoryInterface $customerRequestRepository)
    {}
    public function store(StoreCustomerRequestRequest $request , Brand $brand, Product $product)
    {
        $CustomerRequest = $this->customerRequestRepository->create([
            'full_name'            => $request->full_name,
            'phone_number'         => $request->phone_number,
            'whatsapp_number'      => $request->whatsapp_number,
            'whatsapp_number_code' => $request->whatsapp_number_code,
            'email'                => $request->email ?? null,
            'city'                 => $request->city,
            'governorate'          => $request->governorate,
            'region'               => $request->region,
            'address'              => $request->address,
            'status'               => $request->status,
            'problem_description'  => $request->problem_description,
            'warranty_status'      => $request->warranty_status,
            'note'                 => $request->note,
            'domain'               => $request->domain,
            'brand_id'             => $brand->id,
            'product_id'           => $product->id
        ]);
        return ['data' => $CustomerRequest, 'message' => 'Customer Request Stored Successfully', 'status' => 200];
    }

    public function customers_requests()
    {
        $requests = $this->customerRequestRepository->all();
        if($requests->isEmpty()){
            throw new CustomersRequestsNotFoundException();
        }
        return ['data' => $requests, 'message' => 'Customers Requests', 'status' => 200];
    }

    public function delete_customer_request(CustomerRequest $customerrequest)
    {
        $customerrequest->delete();
        return ['data' => $customerrequest, 'message' => 'Customer Request deleted', 'status' => 200];
    }

    public function search(SearchCustomerRequestRequest $request){
        $query = CustomerRequest::query();
        if(!empty($request->id)){
            $query->where('id',$request->id);
        }
        if($request->phone){
            $query->where('phone_number',$request->phone);
        }
        if($request->brand_name){
            $brand = Brand::where('name',$request->brand_name)->first();
            $query->where('brand_id',$brand->id);
        }
        if($request->status){
            $query->where('status',$request->status);
        }
        if($request->created_at){
            $query->whereDate('created_at',$request->created_at);
        }
        if($request->domain){
            $query->whereDate('domain',$request->domain);
        }
        if(!$request){

        }
        $result = $query->get();
        return ['data' => $result, 'message' => 'Search Result', 'status' => 200];
    }

    public function update(UpdateCustomerRequestRequest $request , CustomerRequest $customerRequest , Brand $brand , Product $product){
        $data = array_filter($request->toArray(), function ($value) {
            return !is_null($value);
        });
        $changes = [];
        foreach ($data as $key => $value) {
            if ($customerRequest->$key != $value) {
                $changes[$key] = $value;
            }
        }
        $changes['brand_id'] = $brand->id;
        $changes['product_id'] = $product->id;
        if (!empty($changes)) {
            $customerRequest->update($changes);
            return ['data' => $customerRequest, 'message' => 'Customer updated successfully', 'status' => 200];
        }
        return ['data' => null, 'message' => 'No changes detected', 'status' => 200];
    }

    public function get_customer_request(CustomerRequest $customerRequest){
        return ['data' => $customerRequest, 'message' => 'Customer Request', 'status' => 200];
    }
}