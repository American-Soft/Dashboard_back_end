<?php 
namespace App\Repositories\interface;

interface UserRepositoryInterface{
    public function all();

    public function findById(int $id);
    
}