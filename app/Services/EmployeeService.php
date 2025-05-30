<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getEmployees() {
        return Employee::paginate(10);
    }

    public function getAllEmployees() {
        return Employee::all();
    }

    public function getEmployee($id) {
        return Employee::find($id);
    }

    public function storeEmployee($input) {
        return Employee::create($input);
    }

    public function updateEmployee(Employee $employee, $input) {
        return $employee->update($input);
    }

    public function deleteEmployee(Employee $employee) {
        return $employee->delete();
    }
}
