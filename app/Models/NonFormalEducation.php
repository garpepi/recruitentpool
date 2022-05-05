<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonFormalEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'course_name',
        'year',
        'duration',
        'certificate'
    ];
}
