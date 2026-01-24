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
        Schema::table('donation_record', function (Blueprint $table) {
            //
            $table->date('collected_date')->nullable()->after('donor_id');
            $table->date('expiration_date')->nullable()->after('collected_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_record', function (Blueprint $table) {
            //
            $table->dropColumn('collected_date');
            $table->dropColumn('expiration_date');
        });
    }
};
