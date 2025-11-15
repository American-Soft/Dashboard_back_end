<?php 
namespace App\Services;

use App\Exceptions\EmployeeNotFoundException;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Repositories\Interface\EmployeeRepositoryInterface;
use App\Services\Interface\EmployeeServiceInterface;

class EmployeeService implements EmployeeServiceInterface{
    public function __construct(protected EmployeeRepositoryInterface $employeeRepository){}

    public function getAllEmployees(){
        return ['data'=>$this->employeeRepository->getAllEmployees(), 'message'=>'Employees Retrieved Successfully' , 'status'=>200];
    }

    public function getEmployee(int $employeeId){
        $employee = $this->employeeRepository->findEmployeeById($employeeId);
        if(!$employee)
            throw new EmployeeNotFoundException();
        return ['data'=>$employee , 'message'=>'Employee Retrieved Successfully' , 'status'=>200];
    }

    public function deleteEmployee(int $employeeId){
        $employee = $this->employeeRepository->findEmployeeById($employeeId);
        if(!$employee)
            throw new EmployeeNotFoundException();
        $this->employeeRepository->deleteEmployee($employeeId);
        return ['data'=>$employee , 'message'=>'Employee Deleted Successfully' , 'status'=>200];
    }

    public function updateEmployee(UpdateEmployeeRequest $request , int $employeeId){
        $employee = $this->employeeRepository->findEmployeeById($employeeId);
        if(!$employee)
            throw new EmployeeNotFoundException();
        $data = array_filter($request->validated(),fn($value) =>  !is_null($value));
        $this->employeeRepository->updateEmployee($data , $employeeId);
        return ['data'=> $employee->refresh(), 'message'=>'Employee Updated Successfully' , 'status'=>200];
    }

    public function createEmployee(StoreEmployeeRequest $request){
        return ['data'=>$this->employeeRepository->createEmployee($request->validated()) , 'message'=>'Employee Created Successfully' , 'status'=>200];
    }
}