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
<<<<<<< Updated upstream
            MODIFY status ENUM('PENDING','ACCEPTED','COMPLETED','CANCELLED','REJECTED')
=======
            MODIFY status ENUM('PENDING','APPROVED','COMPLETED','CANCELLED')
>>>>>>> Stashed changes
            DEFAULT 'PENDING'
        ");
    }

    public function down(): void
    {
        
    }
};