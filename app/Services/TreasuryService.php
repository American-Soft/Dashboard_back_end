<?php 
namespace App\Services;

use App\Repositories\Interface\TreasuryRepositoryInterface;
use App\Services\Interface\TreasuryServiceInterface;

class TreasuryService implements TreasuryServiceInterface{

    public function __construct(protected TreasuryRepositoryInterface $treasuryRepository){}
    public function getTreasury(){
        $result = $this->treasuryRepository->allTreasury();
        return ['data' => $result , 'message' => 'Treasury retrieved success' , 'status' => 200];
    }
}