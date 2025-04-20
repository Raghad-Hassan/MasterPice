<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');                   // عنوان المشروع
            $table->text('description');               // وصف المشروع
            $table->timestamp('start_date');           // تاريخ بداية المشروع
            $table->timestamp('end_date')->nullable(); // تاريخ نهاية المشروع (اختياري)
            $table->string('img')->nullable();         // عمود الصورة (اختياري)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
