<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeDetailResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(){
        $employee = $this->employeeService->getEmployees();

        return Response::responseSuccess(new EmployeeResource($employee));
    }

    public function allEmployees(){
        $employee = $this->employeeService->getAllEmployees();

        return Response::responseSuccess(EmployeeDetailResource::collection($employee));
    }


    public function show(Employee $employee)
    {
        return Response::responseSuccess(new EmployeeDetailResource($employee));
    }

    public function store(EmployeeRequest $request){
        DB::beginTransaction();

        try {
            $repository = $this->employeeService->storeEmployee($request->input());
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function update(EmployeeRequest $request, Employee $employee){
        DB::beginTransaction();

        try {
            $repository = $this->employeeService->updateEmployee($employee, $request->input());
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function destroy(Employee $employee){
        DB::beginTransaction();

        try {
            $repository = $this->employeeService->deleteEmployee($employee);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }
}
