<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequestReqest;
use App\Http\Requests\StoreRequestReqest;
use App\Http\Requests\UpdateRequestReqest;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\trait\ApiResponse;
use Illuminate\Http\Request;


class RequestController extends Controller
{
    use ApiResponse;
    public function store(StoreRequestReqest $request , Brand $brand , Product $product){
        $customer = Customer::where('id' , 1)->first();
        $req = ModelsRequest::create([
            'city'                => $request['city'],
            'governorate'         => $request['governorate'],
            'region'              => $request['region'],
            'address'             => $request['address'],
            'status'              => $request['status'],
            'problem_description' => $request['problem_description'],
            'warranty_status'     => $request['warranty_status'],
            'note'                => $request['note'],
            'domain'              => $request['domain'],
            'brand_id'            => $brand->id,
            'product_id'          => $product->id,
            'customer_id'         => $customer->id
        ]);
        return $this->successResponse($req,'Request Stored Successfully',201);
    }

    public function index(){
        $requests = ModelsRequest::with('customer')->get();
        if($requests->isEmpty())
            return $this->errorResponse('There is no request' , 404);
        return $this->successResponse($requests,'Customers Requests' , 200);
    }

    public function show(ModelsRequest $request){
        $request->load('customer');
        return $this->successResponse($request , 'Customer Request' , 200);
    }

    public function delete(ModelsRequest $request){
        if($request->customer->id == 1)
            return $this->errorResponse('You can not delete this request' , 400);
        $request->customer()->delete();
        return $this->successResponse($request , 'Delete Customer Request' , 200);
    }


    public function update(UpdateRequestReqest $updateRequest,ModelsRequest $request, Brand $brand , Product $product){
        $data = array_filter($updateRequest->toArray(), function ($value) {
            return !is_null($value);
        });
        $changes = [];
        foreach ($data as $key => $value) {
            if ($request->$key != $value) {
                $changes[$key] = $value;
            }
        }
        if (!empty($changes)) {
            $changes['brand_id'] = $brand->id;
            $changes['product_id'] = $product->id;
            $request->update($changes);
            return $this->successResponse( $request, 'request updated successfully',  200);
        }
        return $this->successResponse(null,'No changes detected',  200);
    }

    public function search(Request $request){
        $query = ModelsRequest::query()->with(['customer','brand','product']);
        $result = $query->where(function ($q) use ($request) {
        if ($request->query('id')) {
            $q->where('id', 'like', '%' . $request->id . '%');
        }

        if ($request->query('created_at')) {
            $q->orWhere('created_at', 'like', '%'.$request->created_at.'%');
        }

        if ($request->query('status')) {
            $q->orWhere('status', 'like', '%' . $request->status . '%');
        }

        if ($request->query('domain')) {
            $q->orWhere('domain', 'like', '%' . $request->domain . '%');
        }
        if ($request->query('brand_name')) {
            $q->orWhereHas('brand', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->brand_name . '%');
            });
        }
        if ($request->query('phone_number')) {
            $q->orWhereHas('customer', function ($q) use ($request) {
                $q->where('phone_number', 'like', '%' . $request->phone_number . '%');
            });
        }
    })->get();
        return $this->successResponse($result , 'Search Result' , 200);
    }
}
