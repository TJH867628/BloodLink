<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blood_bags', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donation_record_id')
                ->constrained('donation_record')
                ->cascadeOnDelete();
            $table->string('blood_type', 5);

            $table->foreignId('facility_id')->constrained('medical_facilities');

            $table->enum('status', ['STORED','USED','EXPIRED'])->default('STORED');

            $table->timestamp('collected_at');
            $table->timestamp('expires_at');

            $table->timestamp('used_at')->nullable();
            $table->foreignId('used_by')->nullable()->constrained('users');

            $table->string('patient_ref')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blood_bags');
    }
};
