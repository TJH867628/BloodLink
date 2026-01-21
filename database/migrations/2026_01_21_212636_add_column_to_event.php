<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event', function (Blueprint $table) {
            $table->enum('status', ['ACTIVE', 'CLOSED', 'CANCELLED'])
                  ->default('ACTIVE')
                  ->after('organizer_id');

            $table->integer('total_slots')
                  ->default(0)
                  ->after('status');

            $table->integer('available_slots')
                  ->default(0)
                  ->after('total_slots');

            $table->dateTime('created_at')->nullable()->after('location');
            $table->dateTime('updated_at')->nullable()->after('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn(['status', 'total_slots', 'available_slots']);
        });
    }
};