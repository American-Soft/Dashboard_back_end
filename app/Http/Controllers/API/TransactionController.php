<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\Treasury;
use App\Services\Interface\TransactionServiceInterface;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    use ApiResponse;

    public function __construct(protected TransactionServiceInterface $transactionService){}

    public function index(){
        $result = $this->transactionService->index();
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
    public function depositTransaction(StoreTransactionRequest  $request , int $treasuryId){
        $result = $this->transactionService->depositTransaction($request , $treasuryId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
    public function withdrawTransaction(StoreTransactionRequest  $request , int $treasuryId){
        $result = $this->transactionService->withdrawTransaction($request , $treasuryId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
}
