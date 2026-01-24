<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('blood_inventory', function (Blueprint $table) {
            if (Schema::hasColumn('blood_inventory', 'collected_date')) {
                $table->dropColumn('collected_date');
            }

            if (Schema::hasColumn('blood_inventory', 'expiration_date')) {
                $table->dropColumn('expiration_date');
            }

            $table->string('status')->default('AVAILABLE')->change();
        });
    }

    public function down()
    {
        Schema::table('blood_inventory', function (Blueprint $table) {
            $table->date('collected_date')->nullable();
            $table->date('expiration_date')->nullable();
        });
    }
};
