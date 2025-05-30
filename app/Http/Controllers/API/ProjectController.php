<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProjectRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectDetailResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    public function index(){
        $project = $this->projectService->getProjects();

        return Response::responseSuccess(new ProjectResource($project));
    }

    public function show(Project $project)
    {
        $project = $this->projectService->getProject($project->id);

        return Response::responseSuccess(new ProjectDetailResource($project));
    }

    public function store(ProjectRequest $request){
        DB::beginTransaction();

        try {
            $repository = $this->projectService->storeProject($request);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function update(EditProjectRequest $request, Project $project){
        DB::beginTransaction();

        try {
            $repository = $this->projectService->updateProject($project, $request);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }

    public function destroy(Project $project){
        DB::beginTransaction();

        try {
            $repository = $this->projectService->deleteProject($project);
            DB::commit();

            return Response::responseSuccess(__('messages.success'));
        } catch (\Throwable $e) {
            DB::rollback();

            return Response::responseMessage(__('messages.error'));
        }
    }
}
