<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    protected $fillable = [
        'donor_id',
        'event_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
