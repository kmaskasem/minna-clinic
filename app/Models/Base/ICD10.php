<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class ICD10 extends Model
{
    protected $table = '_icd10'; 
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name_th',
        'name_en',
    ];
}
