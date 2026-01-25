<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFacility extends Model
{
    protected $table = 'medical_facilities';

    protected $fillable = ['name','address','type'];

    public function users()
    {
        return $this->hasMany(User::class, 'facility_id');
    }
}