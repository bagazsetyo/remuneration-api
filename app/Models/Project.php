<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function workRecord()
    {
        return $this->hasOne(WorkRecord::class);
    }
}
