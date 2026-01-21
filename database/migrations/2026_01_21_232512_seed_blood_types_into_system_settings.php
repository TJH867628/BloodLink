<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $bloodTypes = [
            'A+','A-','B+','B-','AB+','AB-','O+','O-'
        ];

        foreach ($bloodTypes as $type) {
            DB::table('system_settings')->updateOrInsert(
                [
                    'name'  => 'blood_type',
                    'value' => $type,
                ],
                [
                    'role'     => 'DONOR',
                    'isActive' => 1,
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('system_settings')
            ->where('name', 'blood_type')
            ->whereIn('value', ['A+','A-','B+','B-','AB+','AB-','O+','O-'])
            ->delete();
    }
};