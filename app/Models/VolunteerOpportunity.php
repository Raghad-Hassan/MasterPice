<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerOpportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'volunteer_hours',
        'location',
        'image',
        'category',
        'city',
        'total_hours',
        'required_hours',
        'days',
        'start_date',
        'end_date',
        'gender',
        'total_volunteers',
        'current_volunteers',
        'transportation',
        'status',
        'start_time',
        'end_time',
        'total_participants',
        'current_participants',
        'working_days',
        'working_hours',
        'min_hours',
        'max_hours',
        'transport_available'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'transport_available' => 'boolean'
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
}