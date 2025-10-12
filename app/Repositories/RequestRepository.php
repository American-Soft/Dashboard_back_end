<?php 
namespace App\Repositories;

use App\Models\Request;

class RequestRepository{
    public function __construct(protected Request $request){}

    public function index(){
        return $this->request->with('customer')->all();
    }
    public function create(array $data){
        return $this->request->create($data);
    }

    public function update(Request $request,array $data){
        $request->update($data);
        return $request->fresh();
    }

    public function delete(Request $request){
        $request->delete();
        return $request->fresh();
    }

    public function show(Request $request){
        return $request->load('customer');
    }
}