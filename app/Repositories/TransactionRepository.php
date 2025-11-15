<?php 
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interface\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface{
    public function __construct(protected Transaction $transaction){}

    public function allTransactions(){
        return $this->transaction->all();
    }

    public function createTransaction($data){
        return $this->transaction->create($data);
    }
}