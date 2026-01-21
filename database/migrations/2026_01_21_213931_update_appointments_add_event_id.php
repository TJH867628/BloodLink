<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment', function (Blueprint $table) {

            // Remove date & time (they come from event)
            $table->dropColumn(['date', 'time']);

            // Link to event
            $table->foreignId('event_id')
                  ->after('donor_id')
                  ->constrained('event')
                  ->onDelete('cascade');

            $table->dateTime('created_at')->nullable()->after('status');
            $table->dateTime('updated_at')->nullable()->after('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
};