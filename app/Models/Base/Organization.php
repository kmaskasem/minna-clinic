<?php

namespace App\Models\Base;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = '_org'; 
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];

    // public function patients()
    // {
    //     return $this->hasMany(Patient::class, 'fac_id');
    // }
}
