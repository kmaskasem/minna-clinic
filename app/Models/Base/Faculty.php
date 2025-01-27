<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = '_fac'; 
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];
}
