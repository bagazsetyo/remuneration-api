<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContributionRequest;
use App\Http\Requests\ContributionUpdateRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\ContributionDetailResource;
use App\Http\Resources\EmployeeDetailResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\EmployeeWorkContribution;
use App\Services\ContributionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{

    protected ContributionService $contributionService;

    public function __construct(ContributionService $contributionService)
    {
        $this->contributionService = $contributionService;
    }

    public function show(EmployeeWorkContribution $contribution)
    {
        return Response::responseSuccess(new ContributionDetailResource($contribution));
    }

    public function store(ContributionRequest $request){
        DB::beginTransaction();

        try {
            $repository = $this->contributionService->storeContribution($request);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function update(ContributionUpdateRequest $request, EmployeeWorkContribution $contribution){
        DB::beginTransaction();

        try {
            $repository = $this->contributionService->updateContribution($contribution, $request);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function destroy(EmployeeWorkContribution $contribution){
        DB::beginTransaction();

        try {
            $repository = $this->contributionService->deleteContribution($contribution);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }
}
