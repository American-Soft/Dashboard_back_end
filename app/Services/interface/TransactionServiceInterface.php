<?php 
namespace App\Services\Interface;

use App\Http\Requests\StoreTransactionRequest;

interface TransactionServiceInterface{
    public function index() ;
    public function depositTransaction(StoreTransactionRequest  $request , int $treasuryId) ;
    public function withdrawTransaction(StoreTransactionRequest  $request , int $treasuryId) ;
}