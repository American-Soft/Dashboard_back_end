<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customerrequest extends Model
{
    protected $fillable = ['full_name', 'phone_number', 'whatsapp_number', 'whatsapp_number_code', 'email'
                            , 'city', 'governorate', 'region', 'address', 'status', 'problem_description', 
                            'warranty_status','note', 'domain', 'brand_id' , 'product_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
