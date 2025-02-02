<?php

namespace App\Models;

use Illuminate\Validation\Rule;
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

    public static function rules()
    {
        return [
            // 'recorded_at' => '',
            'profile_picture' => '',
            'patient_type' => '',
            'code_no' => '',
            'id_card_number' => '',
            'student_id' => '',
            'title' => '',
            'firstname' => '',
            'lastname' => '',
            // 'org_id' => '',
            // 'position_type' => '',
            // 'fac_id' => '',
            'gender' => '',
            'healthcare_code' => 'required',
            'birthday' => 'required',
            'medical_history' => '',
            'smoking_freq' => 'required',
            'alcohol_freq' => 'required',
            // 'alcohol_freq' => ['required', Rule::in(array_keys($this->alcoholFreq))],
            'health_cond' => '',
            'mobile_number' => '',
            // 'internal_phone' => '',
            'email' => 'nullable|email',
        ];
    }

    public static function getNextNumber()
    {
        $prefix = 'PA' . date('Ymd'); 
        $lastPatient = self::where('code_no', 'like', "$prefix%")
                           ->orderBy('code_no', 'desc')
                           ->first();

        $nextNumber = $lastPatient 
            ? ((int)substr($lastPatient->running_number, 10) + 1) 
            : 1;

        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->code_no = self::getNextNumber(); 
        });
    }

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
