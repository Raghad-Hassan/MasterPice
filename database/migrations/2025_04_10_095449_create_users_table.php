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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('nationality')->nullable();
            $table->string('governorate');
            $table->date('birth_date');
            $table->timestamp('email_verified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('role_id')->constrained(); // التأكد من وجود جدول roles
            $table->string('profile_image')->nullable();
            $table->timestamps();
            $table->text('bio')->nullable(); // نبذة عن المستخدم
            $table->string('interests')->nullable(); // مجال الاهتمام
            $table->string('skills')->nullable(); // المهارات
            $table->string('profile_picture')->nullable(); // صورة البروفايل
            $table->timestamp('registered_at')->useCurrent(); // تاريخ التسجيل في المنصة
            $table->text('reason_to_join')->nullable(); // لماذا ترغب بالمشاركة
        
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
