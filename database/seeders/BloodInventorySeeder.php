<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloodInventory;
use Carbon\Carbon;

class BloodInventorySeeder extends Seeder
{
    public function run()
    {
        BloodInventory::insert([
            [
                'blood_type' => 'A+',
                'quantity' => 10,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 1,
            ],
            [
                'blood_type' => 'O+',
                'quantity' => 8,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 1,
            ],
            [
                'blood_type' => 'B+',
                'quantity' => 1,
                'status' => 'CRITICAL',
                'medical_facilities_id' => 1,
            ],
            [
                'blood_type' => 'AB+',
                'quantity' => 3,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 1,
            ],
            [
                'blood_type' => 'O-',
                'quantity' => 4,
                'status' => 'LOW_STOCK',
                'medical_facilities_id' => 1,
            ],
                      [
                'blood_type' => 'A+',
                'quantity' => 10,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 2,
            ],
            [
                'blood_type' => 'O+',
                'quantity' => 8,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 2,
            ],
            [
                'blood_type' => 'B+',
                'quantity' => 1,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 2,
            ],
            [
                'blood_type' => 'AB+',
                'quantity' => 3,
                'status' => 'OPTIMAL',
                'medical_facilities_id' => 2,
            ],
            [
                'blood_type' => 'O-',
                'quantity' => 4,
                'status' => 'LOW_STOCK',
                'medical_facilities_id' => 2,
            ],
        ]);
    }
}