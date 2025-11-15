<?php 
namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interface\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface{

    public function __construct(protected Employee $employee){} 
    public function getAllEmployees(){
        $employees = $this->employee::all();
        $total_salary = $employees->sum('salary');
        return ['employees'=>$employees , 'total_salary'=>$total_salary];
    }

    public function findEmployeeById(int $employeeId){
        return $this->employee::find($employeeId);
    }

    public function deleteEmployee(int $employeeId){
        return $this->employee::destroy($employeeId);
    }

    public function updateEmployee(array $data , int $employeeId){
        return $this->employee::where('id' , $employeeId)->update($data);
    }

    public function createEmployee(array $data){
        return $this->employee::create($data);
    }
}