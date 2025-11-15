<?php 
namespace App\Repositories\Interface;

use App\Models\Treasury;

interface TreasuryRepositoryInterface{
    public function findTreasuryById(int $treasuryId);
    public function increaseDeposit(Treasury $treasury , $amount);

    public function decreaseDeposit(Treasury $treasury , $amount);
}