<?php 
namespace App\Repositories\Interface;

interface EmployeeRepositoryInterface{
    public function getAllEmployees();

    public function findEmployeeById(int $employeeId);

    public function deleteEmployee(int $employeeId);

    public function updateEmployee(array $data , int $employeeId);

    public function createEmployee(array $data);
}