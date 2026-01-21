<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    protected $table = 'system_settings';

    protected $fillable = [
        'name',
        'value',
        'role',
        'isActive'
    ];

    public $timestamps = false;

    // Only blood types
    public function scopeActive($query)
    {
        return $query->where('name', 'blood_type')
                     ->where('isActive', 1);
    }
}