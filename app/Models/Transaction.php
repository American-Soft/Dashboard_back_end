<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'type',
        'amount',
        'user_id',
        'treasury_id',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function treasury()
    {
        return $this->belongsTo(Treasury::class);
    }
}
