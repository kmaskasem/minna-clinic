<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $table = '_usg'; 
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];
}
