<?php

namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\interface\AuthServiceInterface;
use App\trait\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    public function __construct(protected AuthServiceInterface $authServiceInterface){}
    public function register(RegisterRequest $request){
        $result = $this->authServiceInterface->register($request);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }

    public function login(LoginRequest $request){
        $result = $this->authServiceInterface->login($request);
        return $this->successResponse($result['data'], $result['message'], $result['status']); 
    }

    public function logout(Request $request){
        $result = $this->authServiceInterface->logout($request);
        return $this->successResponse($result['data'], $result['message'], $result['status']);
    }
}
