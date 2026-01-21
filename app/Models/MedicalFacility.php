<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFacility extends Model
{
    protected $table = 'medical_facilities';

    protected $fillable = ['name','address','type'];
}