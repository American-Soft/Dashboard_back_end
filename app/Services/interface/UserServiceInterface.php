<?php 
namespace App\Services\interface;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface{
    public function index();
    public function update(UpdateUserRoleRequest $request , User $user);
    public function delete(User $user);
    public function profile(Request $request);
    public function show(User $user);
}