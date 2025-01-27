<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class NCD extends Model
{
    protected $table = '_ncd'; 
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
