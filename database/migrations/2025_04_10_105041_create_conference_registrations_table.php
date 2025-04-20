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
        Schema::create('conference_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('conference_id')->constrained('annual_conferences')->onDelete('cascade');            
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->enum('interest_field', ['education', 'environment', 'health', 'health_support', 'event_management']);
            $table->enum('city', ['amman', 'irbid', 'zarqa', 'karak', 'other']);
            $table->boolean('previous_experience');
            $table->json('skills'); // ['organization', 'management', 'photography', 'marketing', 'content_writing']
            $table->text('participation_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_registrations');
    }
};
