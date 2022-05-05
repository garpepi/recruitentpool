<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'working_experience_id',
        'name',
        'position',
        'division',
        'descriptions'
    ];
}
