<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()       // يربط مع جدول users
                  ->onDelete('cascade'); 
            $table->foreignId('project_id')
                  ->constrained()       // يربط مع جدول projects
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_project');
    }
};
