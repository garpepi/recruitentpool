<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refference extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'name',
        'phone_number',
        'relationship',
        'position'
    ];
}
