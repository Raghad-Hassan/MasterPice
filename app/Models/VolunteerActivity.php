<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerActivity extends Model
{
    use HasFactory;

    // تحديد الأعمدة القابلة للملء
    protected $fillable = ['user_id', 'activity_name', 'activity_date', 'description'];

    // علاقة مع نموذج User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
