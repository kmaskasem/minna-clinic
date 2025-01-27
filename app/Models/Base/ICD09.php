<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class ICD09 extends Model
{
    protected $table = '_icd9'; 
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name_th',
        'name_en',
    ];
}
