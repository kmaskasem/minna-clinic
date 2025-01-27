<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = '_hos'; 
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
