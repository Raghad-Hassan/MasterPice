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
    Schema::create('sustainable_development_goals', function (Blueprint $table) {
        $table->id(); // العمود الأساسي (المعرّف)
        $table->foreignId('organization_id')->constrained()->onDelete('cascade'); // ربط الهدف بالمؤسسة
        $table->string('title'); // عنوان الهدف
        $table->text('description')->nullable(); // وصف الهدف
        $table->string('image')->nullable(); // عمود الصورة (اختياري)
        $table->timestamps(); // إنشاء حقول created_at و updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sustainable_development_goals');
    }
};
