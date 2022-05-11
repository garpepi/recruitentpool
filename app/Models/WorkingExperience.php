<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'working_status',
        'name',
        'industry',
        'address',
        'start',
        'exit',
        'exit_reasons',
        'allowance',
        'salary'
    ];

    public function projects()
    {
        return $this->hasMany(WorkingProject::class, 'working_experience_id');
    }

    public function getLastProject()
    {
        return $this->hasMany(WorkingProject::class, 'working_experience_id')->first();
    }
}
