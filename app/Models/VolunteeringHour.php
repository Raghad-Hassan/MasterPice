<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteeringHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hours',
        'opportunity_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(VolunteerOpportunity::class, 'opportunity_id');
    }
}
