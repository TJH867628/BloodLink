<?php

use App\Models\DonorHealthDetails;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Event as EventModel;
use App\Models\SystemSettings;
use PHPUnit\Event\Telemetry\System;
use App\Models\BloodInventory;
use App\Models\BloodBag;
use App\Models\Notification;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $now = now()->format('Y-m-d H:i:s');

    EventModel::whereRaw(
        "TIMESTAMP(`date`, `time`) <= ?",
        [$now]
    )->update(['status' => 'CLOSED']);

    $targetUnit = SystemSettings::where('name', 'inventory_target_units')->value('value');
    $optimalPct = SystemSettings::where('name', 'inventory_optimal_pct')->value('value');
    $warningPct = SystemSettings::where('name', 'inventory_warning_pct')->value('value');
    $criticalPct = SystemSettings::where('name', 'inventory_critical_pct')->value('value');

    $inventories = BloodInventory::all();

    foreach ($inventories as $inv) {

        $percent = ($inv->quantity / $targetUnit) * 100;

        if ($percent <= $criticalPct) {
            $inv->status = 'CRITICAL';
        } elseif ($percent <= $warningPct) {
            $inv->status = 'LOW_STOCK';
        } elseif ($percent >= $optimalPct) {
            $inv->status = 'OPTIMAL';
        }

        $inv->save();
    }

    $expiredBags = BloodBag::where('expires_at', '<=', $now)
        ->where('status', 'STORED')
        ->get();
    foreach ($expiredBags as $bag) {
        $bag->status = 'EXPIRED';
        $bag->save();

        BloodInventory::where('medical_facilities_id', $bag->facility_id)
            ->where('blood_type', $bag->blood_type)
            ->decrement('quantity', 1);
    }
})->everyThirtySeconds();

Schedule::call(function () {

    $inventories = BloodInventory::with('medicalFacility')->get();

    foreach ($inventories as $inv) {

        if (!in_array($inv->status, ['LOW_STOCK', 'CRITICAL']))
            continue;

        $facility = $inv->medicalFacility;

        if (!$facility)
            continue;

        $title = $inv->status == 'CRITICAL'
            ? "Critical Blood Shortage"
            : "⚠ Low Blood Stock";

        $message = "{$facility->name} has {$inv->quantity} units of {$inv->blood_type} blood remaining ({$inv->status}). Immediate replenishment required.";

        $admins = User::where('role', 'ADMIN')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'message' => $message,
                'status' => "SEND",
                'datetime' => now()
            ]);
        }

        $staff = User::where('role', 'STAFF')
            ->where('facility_id', $facility->id)
            ->get();

        foreach ($staff as $s) {
            Notification::create([
                'user_id' => $s->id,
                'message' => $message,
                'status' => "SEND",
                'datetime' => now()
            ]);
        }
    }
})->daily();

Schedule::call(function () {
    
    $minHemoglobin = SystemSettings::where('name', 'min_hemoglobin')->value('value');

    $allHealth = DonorHealthDetails::all();

    foreach ($allHealth as $health) {

        // LOW → make ineligible
        if ($health->hemoglobin_level < $minHemoglobin && $health->is_eligible == true) {

            Notification::create([
                'user_id' => $health->donor_id,
                'message' => "Your hemoglobin level ({$health->hemoglobin_level} g/dL) is below the minimum required level of {$minHemoglobin} g/dL. You are temporarily not eligible to donate.",
                'status' => "SEND",
                'datetime' => now()
            ]);

            $health->is_eligible = false;
            $health->save();
        }

        // RECOVERED → make eligible again
        if ($health->hemoglobin_level >= $minHemoglobin && $health->is_eligible == false) {

            $health->is_eligible = true;
            $health->save();
        }
    }
})->everyTwoHours();