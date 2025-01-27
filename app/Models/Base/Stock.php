<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = '_stock'; 
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
