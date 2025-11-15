<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    protected $fillable = [
        'amount_deposit',
        'amount_withdraw',
        'total_amount',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
