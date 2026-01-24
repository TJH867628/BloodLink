<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MedicalFacility;
use App\Models\Event;
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

        // ============================
        // Medical Facility
        // ============================
        $hospital = MedicalFacility::create([
            'name' => 'City Central Hospital',
            'type' => 'Hospital',
            'address' => 'Cyberjaya',
        ]);

        // ============================
        // Staff
        // ============================
        $staff = User::create([
            'name' => 'Dr Chai',
            'email' => 'chai@hospital.com',
            'password' => Hash::make('password'),
            'role' => 'STAFF',
            'facility_id' => $hospital->id,
            'is_active' => 1
        ]);

        // ============================
        // 50 Donors + Health Records
        // ============================
        $donors = collect();

        for ($i=1; $i<=50; $i++) {
            $bloodType = $bloodTypes[array_rand($bloodTypes)];

            $donor = User::create([
                'name' => "Donor $i",
                'email' => "donor$i@bloodlink.com",
                'password' => Hash::make('password'),
                'role' => 'DONOR',
                'is_active' => 1
            ]);

            // Health profile
            DonorHealthDetails::create([
                'donor_id' => $donor->id,
                'blood_type' => $bloodType,
                'hemoglobin_level' => rand(120,160)/10,
                'blood_pressure' => rand(110,130).'/'.rand(70,90),
                'height' => rand(155,185),
                'weight' => rand(50,90),
                'is_eligible' => 1,
                'last_donation_date' => null
            ]);

            $donors->push($donor);
        }

        // ============================
        // 6 Past Events + 1 Active
        // ============================
        $events = [];

        for ($i=6; $i>=1; $i--) {
            $events[] = Event::create([
                'name' => "Blood Drive - " . Carbon::now()->subMonths($i)->format('F'),
                'date' => Carbon::now()->subMonths($i)->toDateString(),
                'time' => '09:00',
                'location' => 'City Central Hospital',
                'available_slots' => 100,
                'status' => 'CLOSED',
                'organizer_id' => $staff->id
            ]);
        }

        $events[] = Event::create([
            'name' => 'Emergency Blood Drive',
            'date' => Carbon::now()->addDays(7)->toDateString(),
            'time' => '09:00',
            'location' => 'City Central Hospital',
            'available_slots' => 100,
            'status' => 'ACTIVE',
            'organizer_id' => $staff->id
        ]);

        // ============================
        // Donations with 3-Month Rule
        // ============================
        $inventory = [];

        foreach ($donors as $donor) {

            $health = $donor->donorHealthDetails;

            foreach ($events as $event) {
                if ($event->status !== 'CLOSED') continue;

                // Enforce donation interval
                if ($health->last_donation_date) {
                    $nextEligible = Carbon::parse($health->last_donation_date)->addMonths(3);
                    if (Carbon::parse($event->date)->lt($nextEligible)) {
                        continue;
                    }
                }

                // 70% chance donor donates
                if (rand(1,100) > 70) continue;

                $units = rand(1,3);
                $bloodType = $health->blood_type;

                $donation = DonationRecord::create([
                    'donor_id' => $donor->id,
                    'event_id' => $event->id,
                    'facility_id' => $hospital->id,
                    'hemoglobin_level' => $health->hemoglobin_level,
                    'blood_pressure' => $health->blood_pressure,
                    'unit' => $units,
                    'status' => 'SUCCESSFUL',
                    'staff_id' => $staff->id,
                    'collected_date' => $event->date,
                    'expiration_date' => Carbon::parse($event->date)->addDays(42)
                ]);

                // Create blood bags
                for ($i=0; $i<$units; $i++) {
                    BloodBag::create([
                        'donation_record_id' => $donation->id,
                        'blood_type' => $bloodType,
                        'facility_id' => $hospital->id,
                        'status' => 'STORED',
                        'collected_at' => $event->date,
                        'expires_at' => Carbon::parse($event->date)->addDays(42)
                    ]);
                }

                $inventory[$bloodType] = ($inventory[$bloodType] ?? 0) + $units;
                $health->last_donation_date = $event->date;
                $health->save();
            }
        }

        // ============================
        // Blood Inventory with Correct Status
        // ============================
        foreach ($inventory as $type => $qty) {
            if ($qty >= 80) $status = 'OPTIMAL';
            elseif ($qty >= 30) $status = 'LOW_STOCK';
            elseif ($qty >= 15) $status = 'CRITICAL';

            BloodInventory::create([
                'blood_type' => $type,
                'quantity' => $qty,
                'status' => $status,
                'medical_facilities_id' => $hospital->id
            ]);
        }
    }
}