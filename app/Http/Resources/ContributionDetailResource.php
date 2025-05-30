<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'workRecordId' => $this->work_record_id,
            'employeeId' => $this->employee_id,
            'taskDescription' => $this->task_description,
            'hoursSpent' => $this->hours_spent,
            'hourlyRate' => $this->hourly_rate,
            'date' => $this->date,
        ];
    }
}
