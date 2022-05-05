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
        'industry',
        'address',
        'start',
        'exit',
        'exit_reasons',
        'allowance'
    ];

    public function projects()
    {
        return $this->hasMany(WorkingProject::class, 'working_experience_id');
    }
}
