<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'institution',
        'grades',
        'gpa',
        'city',
        'start',
        'graduates',
        'major'
    ];
}
