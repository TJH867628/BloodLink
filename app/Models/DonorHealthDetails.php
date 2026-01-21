<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorHealthDetails extends Model
{
    use HasFactory;

    protected $table = 'donor_health_details';

    protected $primaryKey = 'id';

    public $timestamps = false; 

    protected $fillable = [
        'donor_id',
        'height',
        'weight',
        'blood_type',
        'blood_pressure',
        'hemoglobin_level',
        'medical_conditions',
        'last_checkup_date',
        'medical_report_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'donor_id', 'id');
    }
}