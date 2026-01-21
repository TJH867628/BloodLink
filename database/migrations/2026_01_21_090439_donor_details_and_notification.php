<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            $table->string('blood_type', 10)->nullable()->after('weight');
            $table->boolean('is_eligible')->nullable()->after('medical_conditions');
        });

        Schema::table('notification', function (Blueprint $table) {
            $table->string('status', 20)->default('unread')->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            $table->dropColumn('blood_type');
            $table->dropColumn('is_eligible');
        });

        Schema::table('notification', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};