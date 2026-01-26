<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('system_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('system_settings', 'created_at')) {
                $table->timestamps();
            }
        });

         DB::table('system_settings')
            ->whereNull('created_at')
            ->update([
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $defaults = [
            ['name' => 'donation_interval_months', 'value' => '3'],
            ['name' => 'min_hemoglobin', 'value' => '12.5'],
            ['name' => 'emergency_mode', 'value' => '0'],
            ['name' => 'overall_target_units', 'value' => '300'],
            ['name' => 'inventory_target_units', 'value' => '60'],
            ['name' => 'inventory_critical_pct', 'value' => '15'],
            ['name' => 'inventory_warning_pct', 'value' => '30'],
            ['name' => 'inventory_optimal_pct', 'value' => '80'],
        ];

        foreach ($defaults as $setting) {
            $exists = DB::table('system_settings')
                ->where('name', $setting['name'])
                ->exists();

            if (!$exists) {
                DB::table('system_settings')->insert([
                    'name'       => $setting['name'],
                    'value'      => $setting['value'],
                    'role'       => 'SYSTEM',
                    'isActive'   => 1,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }
    }

    public function down()
    {
        DB::table('system_settings')->whereIn('name', [
            'donation_interval_months',
            'min_hemoglobin',
            'emergency_mode',
            'inventory_critical_pct',
            'inventory_warning_pct',
            'inventory_optimal_pct',
            'inventory_target_units',
            'overall_target_units',
        ])->delete();
    }
};