<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Block\Document;

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

    public function formalEducation()
    {
        return $this->hasMany(FormalEducation::class)->orderBy('graduates', 'desc');
    }

    public function getLastEducation()
    {
        return $this->hasMany(FormalEducation::class)->orderBy('graduates', 'desc')->first();
    }

    public function nonFormalEducation()
    {
        return $this->hasMany(NonFormalEducation::class)->orderBy('year', 'desc');
    }
  
    public function languages()
    {
        return $this->hasMany(LanguageProficiencies::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function referrences()
    {
        return $this->hasMany(Refference::class);
    }
    
    public function workingExperiences()
    {
        return $this->hasMany(WorkingExperience::class)->orderBy('working_status', 'desc')->orderBy('start', 'desc');
    }

    public function additionalInformation()
    {
        return $this->hasOne(AdditionalInformation::class);
    }

    public function documents()
    {
        return $this->hasMany(Documents::class);
    }

    public function getPhoto()
    {
        return $this->hasMany(Documents::class)->where('type', 'Photo')->first();
    }

}

