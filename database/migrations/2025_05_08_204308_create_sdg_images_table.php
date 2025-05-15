<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sdg_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sustainable_development_goal_id')->constrained()->onDelete('cascade'); // ربط الصورة بالهدف
            $table->string('image');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdg_images');
    }
};
