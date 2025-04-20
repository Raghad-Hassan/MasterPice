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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('organization_name'); // اسم المؤسسة
            $table->string('first_name'); // اسم المدير
            $table->string('last_name'); // اسم العائلة للمدير
            $table->string('phone')->unique(); // رقم الهاتف
            $table->string('email')->unique(); // البريد الإلكتروني
            $table->text('description')->nullable();
            $table->string('password'); // كلمة السر
            $table->string('profile_picture')->nullable(); // صورة البروفايل
            $table->string('website')->nullable();
            $table->string('governorate'); // المحافظة
            $table->enum('sector', ['private', 'NGO']); // القطاع (قطاع خاص أو منظمة غير ربحية)
            $table->string('national_id'); // الرقم الوطني
            $table->enum('volunteer_services', ['yes', 'no']); 
            $table->string('volunteer_type');
            $table->text('bio')->nullable(); 
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
