<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('location', 100);
            $table->date('date');
            $table->time('time');
            $table->text('details')->nullable();
            $table->foreignId('organizer_id')
                  ->constrained('users')
                  ->onDelete('cascade');
        });

        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pending for acception', 'accept', 'done'])
                  ->default('pending for acception');
        });

        Schema::create('donor_health_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('blood_pressure', 20)->nullable();
            $table->double('hemoglobin_level')->nullable();
            $table->string('medical_conditions', 255)->nullable();
            $table->date('last_checkup_date')->nullable();
            $table->string('medical_report_path')->nullable();
        });

        Schema::create('donation_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->integer('unit');
            $table->dateTime('datetime')->nullable();
            $table->foreignId('event_id')
                  ->nullable()
                  ->constrained('event')
                  ->onDelete('set null');
            $table->text('notes')->nullable();
        });

        Schema::create('blood_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('blood_type', 10);
            $table->integer('quantity')->default(450);
            $table->date('collected_date');
            $table->date('expiration_date');
            $table->enum('status', ['STORED', 'USED', 'EXPIRED']);
        });

        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->text('message');
            $table->dateTime('datetime');
        });

        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generated_by')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('type', 50);
            $table->date('generated_date');
            $table->text('content');
        });

        Schema::create('audit_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('action', 255);
            $table->timestamp('timestamp')->useCurrent();
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->text('message');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('value', 255);
            $table->string('role', 50);
            $table->boolean('isActive');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('audit_log');
        Schema::dropIfExists('report');
        Schema::dropIfExists('notification');
        Schema::dropIfExists('blood_inventory');
        Schema::dropIfExists('donation_record');
        Schema::dropIfExists('donor_health_details');
        Schema::dropIfExists('appointment');
        Schema::dropIfExists('event');
        Schema::dropIfExists('users');
    }
};