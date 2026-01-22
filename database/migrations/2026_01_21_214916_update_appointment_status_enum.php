<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE appointment
            MODIFY status ENUM('PENDING','ACCEPTED','COMPLETED','CANCELLED','REJECTED')
            DEFAULT 'PENDING'
        ");
    }

    public function down(): void
    {
        
    }
};