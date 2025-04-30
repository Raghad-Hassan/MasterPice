<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnnualConference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'expected_participants',
        'organizations_count',
        'activities',
        'workshops',
        'status',
        'image' // إذا كان يوجد حقل صورة
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // علاقة مع التسجيلات
    public function registrations()
    {
        return $this->hasMany(ConferenceRegistration::class, 'conference_id');
    }

    // علاقة مع ورش العمل
    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    // علاقة مع الأنشطة
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // Accessor لتنسيق التاريخ
    public function getFormattedDateAttribute()
    {
        return $this->date->format('Y-m-d');
    }

    // Accessor لعرض الحالة كنص
    public function getStatusTextAttribute()
    {
        $statuses = [
            'active' => 'نشط',
            'pending' => 'قيد التنفيذ',
            'inactive' => 'منتهي'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }
}