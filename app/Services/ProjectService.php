<?php

namespace App\Services;

use App\Models\EmployeeWorkContribution;
use App\Models\Project;
use App\Models\WorkRecord;
use Illuminate\Http\Request;

class ProjectService
{
    public function getProjects() {
        return Project::with('workRecord.contributions.employee')->paginate(10);
    }

    public function getProject($id) {
        return Project::with('workRecord.contributions.employee')->find($id);
    }

    public function storeProject(Request $input) {
        $project = Project::create($input->only(['name','description']));

        $workRecord = WorkRecord::create([
            'project_id' => $project->id,
            'start_date' => $input->get('startDate', date('Y-m-d')),
            'additional_charges' => $input->get('additionalCharges', 0),
        ]);

        $contributions = $input->input('employeWorkContribution', []);
        foreach ($contributions as $employeeWorkContribution) {
            $employeWorkContribution = EmployeeWorkContribution::create([
                'work_record_id' => $workRecord->id,
                'employee_id' => $employeeWorkContribution['employeeId'],
                'hours_spent' => $employeeWorkContribution['hoursSpent'],
                'hourly_rate' => $employeeWorkContribution['hourlyRate'],
                'task_description' => $employeeWorkContribution['taskDescription'],
                'date' => $employeeWorkContribution['date'],
            ]);
        }

        return $project;
    }

    public function updateProject(Project $project, $input) {
        $project->update($input->only(['name','description']));

        $project->workRecord()->update([
            'start_date' => $input->get('startDate', date('Y-m-d')),
            'additional_charges' => $input->get('additionalCharges', 0),
        ]);

        return $project;
    }

    public function deleteProject(Project $Project) {
        return $Project->delete();
    }
}
