<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerOpportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'title', 'description', 'category', 'location', 'city', 'start_date', 'end_date',
        'gender', 'total_volunteers', 'current_volunteers', 'min_hours', 'max_hours',
         'status', 'image', 'transportation', 'volunteer_hours', 'days', 'start_time', 'end_time',
        'total_participants', 'current_participants'
    ];
    

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function applications()
    {
        return $this->hasMany(OpportunityApplication::class, 'opportunity_id');
    }

    public function comments()
    {
        return $this->hasMany(OpportunityComment::class, 'opportunity_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'volunteer_opportunities_id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'opportunity_user')
                    ->withPivot('hours', 'approved')
                    ->withTimestamps();
    }

    public function goals()
    {
        return $this->belongsToMany(SustainableDevelopmentGoal::class, 'opportunity_goals');
    }

    // دالة مساعدة للحصول على لون التصنيف
    public function getCategoryColorAttribute()
    {
        $colors = [
            'ريادة' => 'danger',
            'بيئية' => 'success',
            'صحة' => 'info',
            'فنون' => 'warning',
            'تعليم' => 'primary',
            'رياضة' => 'secondary'
        ];

        return $colors[$this->category] ?? 'dark';
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'volunteer_opportunity_user')
                ->withTimestamps()
                ->withPivot('status');
}
}