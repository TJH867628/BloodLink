<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodInventory extends Model
{
    protected $table = 'blood_inventory';
    public $timestamps = true;

    protected $fillable = [
        'blood_type',
        'quantity',
        'status',
        'medical_facilities_id',
    ];

    public function medicalFacility()
    {
        return $this->belongsTo(MedicalFacility::class, 'medical_facilities_id');
    }
}
