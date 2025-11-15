<?php 
namespace App\Repositories\Interface;

interface TransactionRepositoryInterface{
    public function allTransactions();

    public function createTransaction($data);
}