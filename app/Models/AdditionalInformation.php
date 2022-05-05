<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'job_source_info',
        'hospitalize_status',
        'serious_ill',
        'strenght',
        'weakness',
        'overcome_weakness',
        'expected_salary',
        'estimate_join_date',
        'position'
    ];
}
