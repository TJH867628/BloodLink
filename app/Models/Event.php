<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'name',
        'location',
        'date',
        'time',
        'details',
        'organizer_id',
        'status',
        'total_slots',
        'available_slots',
    ];
}
