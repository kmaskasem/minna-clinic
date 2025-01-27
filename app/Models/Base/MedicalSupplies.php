<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class MedicalSupplies extends Model
{
    protected $table = '_medsup'; 
    public $timestamps = false;
    
    protected $fillable = [
        'code',
        'catagory',
        'name',
        'price',
        'unit',
        'unitf',
        'prices',
        'units',
        'description',
    ];
}
