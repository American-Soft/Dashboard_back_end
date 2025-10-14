<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use App\Services\interface\UserServiceInterface;
use App\trait\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ApiResponse;

    public function __construct(protected UserServiceInterface $userServiceInterface){}
    public function index(){
        $result = $this->userServiceInterface->index();
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function update(UpdateUserRoleRequest $request , int $userId){
        $result = $this->userServiceInterface->update($request , $userId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function delete(int $userId){
        $result = $this->userServiceInterface->delete( $userId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function profile(Request $request){
        $result = $this->userServiceInterface->profile($request);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function show(int $userId){
        $result = $this->userServiceInterface->show( $userId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
}
