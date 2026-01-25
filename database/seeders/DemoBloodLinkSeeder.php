<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MedicalFacility;
use App\Models\Event;
use App\Models\Appointment;
use App\Models\DonationRecord;
use App\Models\BloodBag;
use App\Models\BloodInventory;
use App\Models\DonorHealthDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DemoBloodLinkSeeder extends Seeder
{
    public function run()
    {
        $bloodTypes = ['O+','A+','B+','O-','AB+','A-','B-','AB-'];

        /* ============================
           Medical Facility
        ============================ */
        $hospital = MedicalFacility::create([
            'name' => 'City Central Hospital',
            'type' => 'Hospital',
            'address' => 'Cyberjaya',
        ]);

        /* ============================
           Users
        ============================ */
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@bloodlink.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'is_active' => 1
        ]);

        $organizer = User::create([
            'name' => 'Red Cross Organizer',
            'email' => 'organizer@bloodlink.com',
            'password' => Hash::make('password'),
            'role' => 'ORGANIZER',
            'is_active' => 1,
        ]);

        $staff = User::create([
            'name' => 'Dr Chai',
            'email' => 'chai@hospital.com',
            'password' => Hash::make('password'),
            'role' => 'STAFF',
            'facility_id' => $hospital->id,
            'is_active' => 1,
        ]);

        /* ============================
           80 Donors
        ============================ */
        $donors = collect();

        for ($i=1; $i<=80; $i++) {
            $type = $bloodTypes[array_rand($bloodTypes)];

            $donor = User::create([
                'name' => "Donor $i",
                'email' => "donor$i@bloodlink.com",
                'password' => Hash::make('password'),
                'role' => 'DONOR',
                'is_active' => 1,
            ]);

            DonorHealthDetails::create([
                'donor_id' => $donor->id,
                'blood_type' => $type,
                'hemoglobin_level' => rand(120,170)/10,
                'blood_pressure' => rand(110,130).'/'.rand(70,90),
                'height' => rand(150,185),
                'weight' => rand(50,90),
                'is_eligible' => 1,
                'last_donation_date' => null
            ]);

            $donors->push($donor);
        }

        /* ============================
           8 Events in last 30 days
        ============================ */
        $events = [];

        for ($i=1; $i<=8; $i++) {
            $events[] = Event::create([
                'name' => "Blood Drive #$i",
                'date' => Carbon::now()->subDays(rand(3,28))->toDateString(),
                'time' => '09:00:00',
                'location' => 'City Central Hospital',
                'total_slots' => 100,
                'available_slots' => 100,
                'status' => 'CLOSED',
                'organizer_id' => $organizer->id
            ]);
        }

        /* ============================
           Donations & Bags
        ============================ */
        foreach ($events as $event) {

            foreach ($donors as $donor) {

                if (rand(1,100) > 60) continue;

                $health = $donor->donorHealthDetails;

                Appointment::create([
                    'donor_id' => $donor->id,
                    'event_id' => $event->id,
                    'status' => 'COMPLETED'
                ]);

                if (rand(1,100) > 90) continue;

                $collected = Carbon::parse($event->date);
                $expires = $collected->copy()->addDays(42);

                $donation = DonationRecord::create([
                    'donor_id' => $donor->id,
                    'event_id' => $event->id,
                    'facility_id' => $hospital->id,
                    'hemoglobin_level' => $health->hemoglobin_level,
                    'blood_pressure' => $health->blood_pressure,
                    'unit' => 1,
                    'status' => 'SUCCESSFUL',
                    'staff_id' => $staff->id,
                    'collected_date' => $collected,
                    'expiration_date' => $expires
                ]);

                BloodBag::create([
                    'donation_record_id' => $donation->id,
                    'blood_type' => $health->blood_type,
                    'facility_id' => $hospital->id,
                    'status' => 'STORED',
                    'collected_at' => $collected,
                    'expires_at' => $expires
                ]);

                $health->last_donation_date = $collected;
                $health->save();
            }
        }

        /* ============================
           Expire & Use small %
        ============================ */
        $bags = BloodBag::where('facility_id', $hospital->id)->get();

        $expire = (int) ($bags->count() * 0.05);
        $used   = (int) ($bags->count() * 0.10);

        foreach ($bags->random($expire) as $b) {
            $b->update([
                'status' => 'EXPIRED',
                'expires_at' => Carbon::now()->subDays(rand(1,3))
            ]);
        }

        foreach ($bags->where('status','STORED')->random($used) as $b) {
            $b->update([
                'status' => 'USED',
                'used_at' => Carbon::now()->subDays(rand(1,7))
            ]);
        }

        /* ============================
           Inventory (STORED only)
        ============================ */
        foreach ($bloodTypes as $type) {
            $qty = BloodBag::where('facility_id', $hospital->id)
                ->where('blood_type', $type)
                ->where('status', 'STORED')
                ->count();

            if ($qty >= 60) $status = 'OPTIMAL';
            elseif ($qty >= 20) $status = 'LOW_STOCK';
            else $status = 'CRITICAL';

            BloodInventory::create([
                'blood_type' => $type,
                'quantity' => $qty,
                'status' => $status,
                'medical_facilities_id' => $hospital->id
            ]);
        }
    }
}