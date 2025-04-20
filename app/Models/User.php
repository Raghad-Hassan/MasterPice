<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable;
    
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'nationality',
        'governorate',
        'city',
        'birth_date',
        'password',
        'role_id',
        'profile_image',
        'bio',
        'interests',
        'skills',
        'reason_to_join'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function conferenceRegistrations()
    {
        return $this->hasMany(ConferenceRegistration::class);
    }

    public function opportunityApplications()
    {
        return $this->hasMany(OpportunityApplication::class);
    }

    public function opportunityComments()
    {
        return $this->hasMany(OpportunityComment::class);
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function ideaLikes()
    {
        return $this->hasMany(IdeaLike::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function volunteeringHours()
    {
        return $this->hasMany(VolunteeringHour::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function volunteeringStats()
    {
        return $this->hasOne(VolunteeringStats::class);
    }
}