<?php 
namespace App\Repositories\interface;


interface CustomerRequestRepositoryInterface {
    public function create(array $data);
    public function all();
}