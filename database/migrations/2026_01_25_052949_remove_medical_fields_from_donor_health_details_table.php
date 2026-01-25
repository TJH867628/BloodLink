<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            if (Schema::hasColumn('donor_health_details', 'last_checkup_date')) {
                $table->dropColumn('last_checkup_date');
            }

            if (Schema::hasColumn('donor_health_details', 'medical_report_path')) {
                $table->dropColumn('medical_report_path');
            }

            if (Schema::hasColumn('donor_health_details', 'medical_conditions')) {
                $table->dropColumn('medical_conditions');
            }
        });
    }

    public function down()
    {
        Schema::table('donor_health_details', function (Blueprint $table) {
            $table->date('last_checkup_date')->nullable();
            $table->string('medical_report_path')->nullable();
            $table->text('medical_conditions')->nullable();
        });
    }
};
