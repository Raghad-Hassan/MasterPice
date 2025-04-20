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
        Schema::create('volunteering_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained() ->onDelete('cascade');       // إذا انحذف المستخدم، تنحذف السجلات المرتبطة
            $table->integer('hours') ->default(0);   // عدد الساعات التطوعية
            $table->foreignId('opportunity_id')->constrained('volunteer_opportunities') ->onDelete('cascade'); // ربط مع جدول الفرص التطوعية
            $table->timestamps();              // يضيف created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteering_hours');
    }
};
