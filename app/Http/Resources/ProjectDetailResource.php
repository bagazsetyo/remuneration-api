<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $employeeSummary = $this->calculateCharge($this);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'createdDate' => Carbon::parse($this->created_at)->format('d F Y'),
            'additionalCharges' => $this->workRecord->additional_charges,
            'startDate' => Carbon::parse($this->workRecord->start_date)->format('d F Y'),
            'contributions' => $employeeSummary,
        ];
    }

    private function calculateCharge($data)
    {
        $groupedContributions = $data->workRecord->contributions
            ->groupBy('employee_id')
            ->map(function ($contributions) {
                return $contributions->map(function ($contribution) {
                    $contribution->total_contribution = $contribution->hours_spent * $contribution->hourly_rate;
                    return $contribution;
                });
            });

        $totalSpentHours = $groupedContributions
            ->flatten()
            ->sum('hours_spent');

        $employeeSummary = [];
        foreach ($groupedContributions as $employeeId => $contributions) {
            $employee = $contributions->first()->employee;
            $totalContribution = $contributions->sum('total_contribution');
            $totalHours = $contributions->sum('hours_spent');

            $hourPercentage = ($totalHours / $totalSpentHours);
            $charge = round($hourPercentage * $data->workRecord->additional_charges);

            $contributionsCamelCase = [];
            foreach ($contributions->toArray() as $contribution) {
                $tempData = [];
                foreach ($contribution as $key => $val) {
                    if($key == 'employee'){
                        continue;
                    }
                    $tempData[\Str::camel($key)] = $val;
                }
                $contributionsCamelCase[] = $tempData;
            }

            $employeeSummary[$employeeId] = [
                'employeeId' => $employeeId,
                'employeeName' => $employee->name,
                'totalContribution' => $totalContribution,
                'totalHours' => $totalHours,
                'hourPercentage' => round(($hourPercentage) * 100, 2),
                'charge' => number_format($charge, 0, ',','.'),
                'total' => number_format($charge + $totalContribution, 0, ',', '.'),
                'detail' => $contributionsCamelCase,
            ];
        }

        return $employeeSummary;
    }
}
