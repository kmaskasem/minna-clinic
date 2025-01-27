<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = '_org'; 
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];
}
