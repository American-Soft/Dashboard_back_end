<?php 
namespace App\Repositories\interface;

use App\Models\Request;

interface RequestRepositoryInterface{
    public function all($perPage, $pageName = 'page');
    public function update(Request $request,array $data);
    public function delete(Request $request);
    public function show(Request $request);
    public function search(array $data);
    public function findById($id);

    public function store(array $data);
}