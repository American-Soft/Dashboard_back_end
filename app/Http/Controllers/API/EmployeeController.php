<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\Interface\EmployeeServiceInterface;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ApiResponse;
    public function __construct(protected EmployeeServiceInterface $employeeService){}
    public function Employees()
    {
        $result = $this->employeeService->getAllEmployees();
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function createEmployee(StoreEmployeeRequest $request){
        $result = $this->employeeService->createEmployee($request);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function updateEmployee(UpdateEmployeeRequest $request , int $employeeId){
        $result = $this->employeeService->updateEmployee($request , $employeeId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function deleteEmployee(int $employeeId){
        $result = $this->employeeService->deleteEmployee($employeeId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }

    public function showEmployee(int $employeeId){
        $result = $this->employeeService->getEmployee($employeeId);
        return $this->successResponse($result['data'] , $result['message'] , $result['status']);
    }
}
