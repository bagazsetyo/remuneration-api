<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkRecord extends Model
{
    protected $fillable = [
        'project_id',
        'start_date',
        'completed_date',
        'additional_charges',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contributions()
    {
        return $this->hasMany(EmployeeWorkContribution::class);
    }
}
