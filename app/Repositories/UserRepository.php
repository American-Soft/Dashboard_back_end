<?php 
namespace App\Repositories;

use App\Models\User;
use App\Repositories\interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{
    public function all(){
        return User::with('roles')->get();
    }

    public function findById(int $id){
        return User::with('roles')->where('id' , $id)->first();
    }
}