<?php 
namespace App\Services\Interface;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

interface EmployeeServiceInterface{
    public function getAllEmployees();

    public function getEmployee(int $employeeId);

    public function deleteEmployee(int $employeeId);

    public function updateEmployee(UpdateEmployeeRequest $data , int $employeeId);

    public function createEmployee(StoreEmployeeRequest $data);
}