<?php 
namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\interface\AuthRepositoryInterface;
use App\Services\interface\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface{
    public function __construct(protected AuthRepositoryInterface $authRepositoryInterface){}
    public function register(RegisterRequest $request){
        $user = $this->authRepositoryInterface->create([
            'name'         => $request['name'],
            'email'        => $request['email'],
            'password'     => bcrypt($request['password']),
        ]);
        $user->assignRole($request['role']);
        $user->role = $user->getRoleNames();
        return ['data' => $user , 'message' => 'User registered successfully' , 'status' => 201];
    }

    public function login(LoginRequest $request){
        $user = $this->authRepositoryInterface->findByEmail($request['email']);
        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw new AuthenticationException();
        }
        $user->tokens()->where('name', 'auth_token')->delete();
        $user->token= $user->createToken('auth_token')->plainTextToken;
        $user->role = $user->getRoleNames();
        return ['data' => $user , 'message' => 'User login successfully' , 'status' => 200];
    }

    public function logout(Request $request){
        $request->user()->tokens()->where('name', 'auth_token')->delete();
        return ['data' => $request->user() , 'message' => 'User logout successfully' , 'status' => 200];
    }
}