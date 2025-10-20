<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'brand_id'];

    protected $hidden = ['created_at' , 'updated_at'];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    
}
