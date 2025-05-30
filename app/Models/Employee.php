<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function contributions()
    {
        return $this->hasMany(EmployeeWorkContribution::class);
    }
}
