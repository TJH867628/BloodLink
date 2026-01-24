<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    protected $table = 'system_settings';

    protected $fillable = [
        'name',
        'value',
        'role',
        'isActive',
    ];

    protected $casts = [
        'isActive' => 'boolean',
    ];
}