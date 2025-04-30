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
        Schema::create('volunteer_opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('volunteer_hours'); // عدد ساعات التطوع
            $table->string('location'); // الموقع   
            $table->string('image')->nullable();
            $table->enum('category', ['entrepreneurship', 'environment', 'health', 'arts', 'education', 'sports', 'other']);
            $table->enum('city', ['amman', 'zarqa', 'irbid', 'ajloun', 'mafraq', 'kareem', 'madaba', 'tafilah', 'maan', 'batn', 'jerash', 'aqaba']);
            $table->integer('total_hours'); //
            $table->string('days')->nullable(); // الأيام (اختياري)
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('gender', ['all', 'male', 'female'])->default('all');
            $table->integer('total_volunteers');
            $table->integer('current_volunteers')->default(0);
            $table->enum('transportation', ['available', 'unavailable'])->nullable(); // وسائل النقل (اختياري)
            $table->enum('status', ['available', 'full']);
            $table->time('start_time')->nullable(); 
            $table->time('end_time')->nullable(); // وقت النهاية (اختياري)
            $table->integer('total_participants')->default(0); 
            $table->integer('current_participants')->default(0); // عدد المتطوعين الحاليين
            $table->integer('min_hours');
            $table->integer('max_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_opportunities');
    }
};
