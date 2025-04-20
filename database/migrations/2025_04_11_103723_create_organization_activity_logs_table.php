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
        Schema::create('organization_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained(); // المستخدم الذي قام بالإجراء
            $table->string('action'); // نوع الإجراء (مثل create, update, delete)
            $table->string('model_type'); // نوع الكائن المتأثر (مثل Opportunity, Application)
            $table->unsignedBigInteger('model_id')->nullable(); // المعرف الخاص بالكائن المتأثر
            $table->json('old_data')->nullable(); // البيانات القديمة (قبل التعديل)
            $table->json('new_data')->nullable(); // البيانات الجديدة (بعد التعديل)
            $table->ipAddress('ip_address'); // عنوان الـ IP الخاص بالمستخدم
            $table->string('user_agent')->nullable(); // وكيل المستخدم (الذي يتضمن متصفح المستخد
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_activity_logs');
    }
};
