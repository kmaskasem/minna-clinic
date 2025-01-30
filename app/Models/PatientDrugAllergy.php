<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDrugAllergy extends Model
{
    // use HasFactory;

    protected $table = '_patient_drug_allergy';

    protected $fillable = [
        'patient_id',
        'drug',
        'allergy_symptoms',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
