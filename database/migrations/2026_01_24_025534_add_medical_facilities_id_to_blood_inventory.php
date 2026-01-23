<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blood_inventory', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('medical_facilities_id')->nullable()->after('status');
            $table->foreign('medical_facilities_id')->references('id')->on('medical_facilities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blood_inventory', function (Blueprint $table) {
            //
            $table->dropForeign(['medical_facilities_id']);
            $table->dropColumn('medical_facilities_id');
        });
    }
};
