<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->date('date');                   // تاريخ المؤتمر
            $table->string('location');             // مكان المؤتمر
            $table->integer('volunteers_count');    // عدد المتطوعين
            $table->integer('organizations_count'); // عدد المنظمات المشاركة
            $table->text('workshops');              // ورش العمل
            $table->text('goals');                  // أهداف المؤتمر
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
