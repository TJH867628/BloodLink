<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            $table->date('last_donation_date')->nullable()->after('last_checkup_date');
        });
    }

    public function down()
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            $table->dropColumn('last_donation_date');
        });
    }
};
