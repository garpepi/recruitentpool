<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'link_bkp',
        'fullname',
        'email',
        'id_number',
        'tax_number',
        'home_address',
        'home_phone',
        'mobile_phone',
        'date_of_birth',
        'place_of_birth',
        'religion',
        'gender',
        'freshgraduate',
        'blood_type',
        'citizenship',
        'marital_status',
        'mariage_year'
    ];

    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
