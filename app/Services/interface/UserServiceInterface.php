<?php 
namespace App\Services\interface;

use App\Http\Requests\UpdateUserRoleRequest;
use Illuminate\Http\Request;

interface UserServiceInterface{
    public function index();
    public function update(UpdateUserRoleRequest $request , int $userId);
    public function delete(int $userId);
    public function profile(Request $request);
    public function show(int $userId);
}