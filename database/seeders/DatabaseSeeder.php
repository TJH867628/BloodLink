<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('medical_facilities')->insert([
            [
                'name' => 'Johor General Hospital',
                'address' => 'Johor Bahru',
                'type' => 'HOSPITAL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Red Cross Mobile Unit',
                'address' => 'JB City',
                'type' => 'CLINIC',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $hospitalId = DB::table('medical_facilities')
        ->where('type','HOSPITAL')
        ->first()->id;

        DB::table('users')->insert([
            [
                'name' => 'Donor',
                'email' => 'donor@mail.com',
                'password' => Hash::make('test'),
                'role' => 'DONOR',
                'facility_id' => null
            ],
            [
                'name' => 'Event Organizer',
                'email' => 'event@mail.com',
                'password' => Hash::make('test'),
                'role' => 'ORGANIZER',
                'facility_id' => null
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@mail.com',
                'password' => Hash::make('test'),
                'role' => 'STAFF',
                'facility_id' => $hospitalId
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('test'),
                'role' => 'ADMIN',
                'facility_id' => null
            ],
        ]);
    }
}
