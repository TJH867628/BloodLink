<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Event as EventModel;
use App\Models\SystemSettings;
use PHPUnit\Event\Telemetry\System;
use App\Models\BloodInventory;
use App\Models\BloodBag;

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
        }
        elseif ($percent <= $warningPct) {
            $inv->status = 'LOW_STOCK';
        }
        elseif ($percent >= $optimalPct) {
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