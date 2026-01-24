<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRecord extends Model
{
    protected $table = 'donation_record';

    protected $fillable = [
        'appointment_id',
        'donor_id',
        'event_id',
        'facility_id',
        'staff_id',
        'unit',
        'notes',
        'hemoglobin_level',
        'blood_pressure',
        'status',
        'staff_id',
        'created_at',
        'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function facility()
    {
        return $this->belongsTo(MedicalFacility::class, 'facility_id');
    }
}