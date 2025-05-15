<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE ideas MODIFY status ENUM('pending', 'approved', 'rejected', 'hidden_from_institution') DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE ideas MODIFY status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'");
    }
};
