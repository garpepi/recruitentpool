<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageProficiencies extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'language',
        'written',
        'speaking',
        'reading'
    ];
}
