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
       
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->text('message'); // محتوى الرسالة أو الرأي
            $table->foreignId('user_id')->nullable()->constrained(); // ربط الرسالة بالمستخدم (اختياري)
            $table->timestamps(); // هذا يضيف عمودي created_at و updated_at تلقائيًا
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
