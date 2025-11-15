<?php 
namespace App\Services;

use App\Models\Treasury;
use App\Repositories\Interface\TreasuryRepositoryInterface;

class TreasuryRepository implements TreasuryRepositoryInterface{
    public function __construct(protected Treasury $treasury){}
    public function increaseDeposit(Treasury $treasury , $amount){
        $treasury->increment('amount_deposit' , $amount);
        $treasury->increment('total_amount' , $amount);
    }

    public function decreaseDeposit(Treasury $treasury , $amount){
        $treasury->decrement('amount_deposit' , $amount);
        $treasury->decrement('total_amount' , $amount);
    }
    public function findTreasuryById(int $treasuryId){
        return Treasury::find($treasuryId);
    }
}