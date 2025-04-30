<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'idea_region',
        'idea_description',
        'title',
        'image',
        'field',
        'city',
        'idea_goals',
        'duration_days',
        'related_entities',
        'idea_duration',
        'idea_authorities',
        'status'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function likes()
{
    return $this->hasMany(IdeaLike::class);
}
}