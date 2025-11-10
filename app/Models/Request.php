<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $fillable = ['city', 'governorate', 'region', 'address', 'status', 'problem_description', 
                            'warranty_status','note', 'domain','technician_name','device_drag_time','device_delivery_time',
                            'is_location','is_image', 'brand_id' , 'product_id' , 'customer_id'];

    protected $casts = ['note' => 'array'];
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class , 'customer_id');
    }
}
