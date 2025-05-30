<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkContribution extends Model
{
    protected $fillable = [
        'work_record_id',
        'employee_id',
        'hours_spent',
        'hourly_rate',
        'task_description',
        'date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function workRecord()
    {
        return $this->belongsTo(WorkRecord::class);
    }
}
