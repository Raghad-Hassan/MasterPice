<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = ['message', 'user_id'];

    // علاقة بين الفيدباك والمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // إذا أردت التأكد من وجود المستخدم، يمكن التحقق إذا كانت `user_id` موجودة
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : 'مستخدم غير مسجل';
    }
}
