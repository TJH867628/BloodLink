<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            ALTER TABLE blood_inventory 
            MODIFY status ENUM('OPTIMAL','LOW_STOCK','CRITICAL') 
            DEFAULT 'OPTIMAL'
        ");
    }

    public function down()
    {
        DB::statement("
            ALTER TABLE blood_inventory 
            MODIFY status ENUM('OPTIMAL','LOW_STOCK','CRITICAL') 
        ");
    }
};