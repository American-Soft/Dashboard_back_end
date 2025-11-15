<?php 
namespace App\Services;

use App\Exceptions\TreasuryNotFoundException;
use App\Http\Requests\StoreTransactionRequest;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\Interface\TreasuryRepositoryInterface;
use App\Services\Interface\TransactionServiceInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class TransactionService implements TransactionServiceInterface{

    public function __construct(
        protected TransactionRepositoryInterface $transactionRepository,
        protected TreasuryRepositoryInterface $treasuryRepository){}
    public function index(){
        return ['data' => $this->transactionRepository->allTransactions() , 'message' => 'Transactions retrieved successfully' , 'status' =>200];
    }
    public function depositTransaction(StoreTransactionRequest  $request , int $treasuryId){
        return DB::transaction(function () use ($request , $treasuryId){
            $treasury = $this->treasuryRepository->findTreasuryById($treasuryId);
            if(!$treasury) 
                throw new TreasuryNotFoundException();
            $this->transactionRepository->createTransaction($request->validated()+['user_id' => $request->user()->id , 'type' => 'deposit']);
            $this->treasuryRepository->increaseDeposit($treasury , $request->amount);
            return ['data' => $treasury , 'message' => 'Deposit transaction successfully' , 'status' =>200];
        });
    }
    public function withdrawTransaction(StoreTransactionRequest  $request , int $treasuryId){
        return DB::transaction(function () use ($request , $treasuryId){
            $treasury = $this->treasuryRepository->findTreasuryById($treasuryId);
            if(!$treasury) 
                throw new TreasuryNotFoundException();
            if($treasury->total_amount < $request->amount)
                throw new Exception('Insufficient balance');
            $this->transactionRepository->createTransaction($request->validated()+['user_id' => $request->user()->id , 'type' => 'withdraw']);
            $this->treasuryRepository->decreaseDeposit($treasury , $request->amount);
            return ['data' => $treasury , 'message' => 'withdraw transaction successfully' , 'status' =>200];
        });
    }
}