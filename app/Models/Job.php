<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'level',
        'estimated_duration',
    ];

    protected $casts = [
        'level'              => 'int',
        'estimated_duration' => 'int',
    ];
}
