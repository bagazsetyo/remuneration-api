<?php

namespace App\Services;

use App\Models\EmployeeWorkContribution;
use App\Models\WorkRecord;
use Illuminate\Http\Request;

class ContributionService
{
    public function getContribution($id) {
        return EmployeeWorkContribution::with('employee')->find($id);
    }

    public function storeContribution(Request $input) {
        $contribution = EmployeeWorkContribution::create([
            'work_record_id' => $input->get('workRecordId'),
            'employee_id' => $input->get('employeeId'),
            'hours_spent' => $input->get('hoursSpent'),
            'hourly_rate' => $input->get('hourlyRate'),
            'task_description' => $input->get('taskDescription'),
            'date' => $input->get('date', date('Y-m-d')),
        ]);

        return $contribution;
    }

    public function updateContribution(EmployeeWorkContribution $contribution, $input) {
        $contribution->update([
            'employee_id' => $input->get('employeeId'),
            'hours_spent' => $input->get('hoursSpent'),
            'hourly_rate' => $input->get('hourlyRate'),
            'task_description' => $input->get('taskDescription'),
            'date' => $input->get('date', date('Y-m-d')),
        ]);

        return $contribution;
    }

    public function deleteContribution(EmployeeWorkContribution $contribution) {
        return $contribution->delete();
    }
}
