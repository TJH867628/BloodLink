<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create hospital / clinic table
        Schema::create('medical_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->enum('type', ['HOSPITAL','CLINIC','MOBILE']);
            $table->timestamps();
        });

        // Add timestamps to donation_record (replaces donated_at)
        Schema::table('donation_record', function (Blueprint $table) {
            if (Schema::hasColumn('donation_record', 'donated_at')) {
                $table->dropColumn('donated_at');
            }
            if (Schema::hasColumn('donation_record', 'datetime')) {
                $table->dropColumn('datetime');
            }
            $table->timestamps();
        });

        // Add relations
        Schema::table('donation_record', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id')->nullable()->after('id');
            $table->unsignedBigInteger('donor_id')->nullable()->after('appointment_id');
            $table->unsignedBigInteger('event_id')->nullable()->after('donor_id');
            $table->unsignedBigInteger('facility_id')->nullable()->after('event_id');
            $table->unsignedBigInteger('staff_id')->nullable()->after('facility_id');
        });

        // Foreign keys
        Schema::table('donation_record', function (Blueprint $table) {
            $table->foreign('appointment_id')->references('id')->on('appointment')->onDelete('cascade');
            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('medical_facilities')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('donation_record', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['donor_id']);
            $table->dropForeign(['event_id']);
            $table->dropForeign(['facility_id']);
            $table->dropForeign(['staff_id']);

            $table->dropColumn(['appointment_id','donor_id','event_id','facility_id','staff_id']);

            $table->dropTimestamps();
            $table->dateTime('donated_at')->nullable();
        });

        Schema::dropIfExists('medical_facilities');
    }
};