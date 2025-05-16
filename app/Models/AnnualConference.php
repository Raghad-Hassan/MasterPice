<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image',
        'active'
    ];

    protected $casts = [
        'date' => 'date',
        'active' => 'boolean'
    ];

    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function registrations()
    {
        return $this->hasMany(ConferenceRegistration::class);
    }
}