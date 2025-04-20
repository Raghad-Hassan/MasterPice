<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conference_id',
        'full_name',
        'email',
        'phone',
        'interest_field',
        'city',
        'previous_experience',
        'skills',
        'participation_reason'
    ];

    protected $casts = [
        'skills' => 'array',
        'previous_experience' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conference()
    {
        return $this->belongsTo(AnnualConference::class, 'conference_id');
    }
}