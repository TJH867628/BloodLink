<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBag extends Model
{
    protected $table = 'blood_bags';

    protected $fillable = [
        'donation_record_id',
        'blood_type',
        'facility_id',
        'status',
        'collected_at',
        'expires_at',
        'used_at',
    ];

    protected $casts = [
        'collected_at' => 'datetime',
        'expires_at'   => 'datetime',
        'used_at'      => 'datetime',
    ];

    public function donationRecord()
    {
        return $this->belongsTo(DonationRecord::class);
    }

    public function facility()
    {
        return $this->belongsTo(MedicalFacility::class, 'facility_id');
    }

}