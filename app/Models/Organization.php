<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        
        'organization_name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'description',
        'password',
        'profile_picture',
        'website',
        'governorate',
        'sector',
        'national_id',
        'volunteer_services',
        'volunteer_type',
        'bio',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function volunteerOpportunities()
    {
        return $this->hasMany(VolunteerOpportunity::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(OrganizationActivityLog::class);
    }

    public function sustainableDevelopmentGoals()
    {
        return $this->hasMany(SustainableDevelopmentGoal::class);
    }
}