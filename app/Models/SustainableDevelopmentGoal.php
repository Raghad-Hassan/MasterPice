<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainableDevelopmentGoal extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلفاً عن اسم الموديل (اختياري)
    protected $table = 'sustainable_development_goals';

    // تحديد الحقول التي يمكن ملؤها (Mass Assignment)
    protected $fillable = [
        'title', 'description', 'image', 'organization_id',
    ];

    // تحديد العلاقة مع الجدول الآخر (المؤسسة)
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function images()
{
    return $this->hasMany(SdgImage::class);
}

public function opportunities()
{
    return $this->hasMany(VolunteerOpportunity::class, 'goal_id');
}
}
