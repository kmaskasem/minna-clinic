<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = '_drug'; 
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
