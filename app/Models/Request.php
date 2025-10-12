<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $fillable = ['city', 'governorate', 'region', 'address', 'status', 'problem_description', 
                            'warranty_status','note', 'domain', 'brand_id' , 'product_id' , 'customer_id'];
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
