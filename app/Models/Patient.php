<?php

namespace App\Models;

use App\Models\Base\Faculty;
use App\Models\Base\Organization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // use HasFactory;

    protected $table = '_patient';

    protected $fillable = [
        'recorded_at',
        'profile_picture',
        'patient_type',
        'code_no',
        'id_card_number',
        'student_id',
        'title',
        'firstname',
        'lastname',
        'org_id',
        'position_type',
        'fac_id',
        'gender',
        'healthcare_code',
        'birthday',
        'medical_history',
        'smoking_freq',
        'alcohol_freq',
        'health_cond',
        'blood_type',
        'mobile_number',
        'internal_phone',
        'email',
    ];

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function fac()
    {
        return $this->belongsTo(Faculty::class, 'fac_id');
    }

    public function allergies()
    {
        return $this->hasMany(PatientDrugAllergy::class, 'patient_id');
    }
}
