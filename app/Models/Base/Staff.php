<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = '_stf'; 
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
