<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'volunteer_opportunities_id',
        'title',
        'organization',
        'image_path',
        'issue_date'
    ];

    protected $casts = [
        'issue_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(VolunteerOpportunity::class, 'volunteer_opportunities_id');
    }
}