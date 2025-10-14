<?php 
namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\UsersNotFoundException;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use App\Repositories\interface\UserRepositoryInterface;
use App\Services\interface\UserServiceInterface;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface{

    public function __construct(protected UserRepositoryInterface $userRepositoryInterface){}
    public function index(){
        $users = $this->userRepositoryInterface->all();
        if($users->isEmpty()
            ){
            throw new UsersNotFoundException();
        }
        return ['data' => $users , 'message' => 'Users retrieved successfully' , 'status' =>200];
    }

    public function update(UpdateUserRoleRequest $request , int $userId){
        $user = $this->userRepositoryInterface->findById($userId);
        if(!$user){
            throw new UserNotFoundException();
        }
        $user->syncRoles($request['role']);
        return ['data' => $user , 'message' => 'User updated role successfully' , 'status' =>200];
    }

    public function delete(int $userId){
        $user = $this->userRepositoryInterface->findById($userId);
        if(!$user){
            throw new UserNotFoundException();
        }
        $user->delete();
        return ['data' => $user , 'message' => 'User deleted successfully' , 'status' =>200];
    }
    public function profile(Request $request){
        $user = $this->userRepositoryInterface->findById($request->user()->id);
        if(!$user){
            throw new UserNotFoundException();
        }
        return ['data' => $user , 'message' => 'User retrieved successfully' , 'status' =>200];
    }
    public function show(int $userId){
        $user = $this->userRepositoryInterface->findById($userId);
        if(!$user){
            throw new UserNotFoundException();
        }
        return ['data' => $user , 'message' => 'User retrieved successfully' , 'status' =>200];
    }
}