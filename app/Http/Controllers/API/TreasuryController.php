<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interface\TreasuryServiceInterface;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    use ApiResponse;
    public function __construct(protected TreasuryServiceInterface $treasuryService){}
    public function getTreasury(){
        $result = $this->treasuryService->getTreasury();
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
}
