<?php 
namespace App\Repositories\interface;

interface AuthRepositoryInterface{
    public function create(array $data);

    public function findByEmail($email);
}