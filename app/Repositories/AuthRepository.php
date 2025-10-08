<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\interface\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface{
    public function __construct(protected User $user){}
    public function create(array $data){
        return $this->user->create($data);
    }

    public function findByEmail($email){
        return $this->user->where('email',$email)->first();
    }
}