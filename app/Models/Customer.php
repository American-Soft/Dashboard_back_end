<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['full_name', 'phone_number', 'whatsapp_number', 'whatsapp_number_code', 'email','address'];

    protected $hidden = ['updated_at'];
    public function requests(){
        return $this->hasMany(Request::class , 'customer_id');
    }
}
