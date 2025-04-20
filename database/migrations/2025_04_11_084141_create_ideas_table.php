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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('idea_region'); 
            $table->text('idea_description'); 
            $table->string('title'); 
            $table->string('image')->nullable(); 
            $table->enum('field', ['education', 'health', 'environment', 'technology', 'social']); 
            $table->enum('city', ['amman', 'zarqa', 'irbid', 'ajloun', 'mafraq', 'kareem', 'madaba', 'tafilah', 'maan', 'batn', 'jerash', 'aqaba']); // المدينة
            $table->text('description'); 
            $table->text('idea_goals'); // الأهداف التي تحققها الفكرة
            $table->integer('duration_days'); 
            $table->string('related_entities'); 
            $table->integer('idea_duration'); // المدة المقترحة لتنفيذ الفكرة
            $table->string('idea_authorities'); // الجهات المعنية$table->integer('likes_count')->default(0); 
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); 
            $table->timestamps(); 
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
