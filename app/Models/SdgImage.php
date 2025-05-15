<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdgImage extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بالموديل (إذا كان اسم الجدول غير معترف به تلقائيًا من قبل Laravel)
    protected $table = 'sdg_images';

    // تحديد الأعمدة التي يمكن ملؤها (Mass Assignment)
    protected $fillable = ['sustainable_development_goal_id', 'image'];

    // علاقة الموديل مع هدف التنمية المستدامة (Sustainable Development Goal)
    public function goal()
    {
        return $this->belongsTo(SustainableDevelopmentGoal::class, 'sustainable_development_goal_id');
    }
}
