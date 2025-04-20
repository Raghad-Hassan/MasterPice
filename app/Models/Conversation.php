<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'subject',
        'is_closed',
    ];

    // علاقة مع المستخدم الأساسي
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع المنظمة
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // علاقة مع الرسائل
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
