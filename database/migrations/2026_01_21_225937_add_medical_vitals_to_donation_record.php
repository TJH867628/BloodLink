<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation_record', function (Blueprint $table) {
            $table->double('hemoglobin_level')->nullable()->after('unit');
            $table->string('blood_pressure', 20)->nullable()->after('hemoglobin_level');
        });
    }

    public function down(): void
    {
        Schema::table('donation_record', function (Blueprint $table) {
            $table->dropColumn(['hemoglobin_level','blood_pressure']);
        });
    }
};