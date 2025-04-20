<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'idea_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    public function isLikedByUser($userId)
{
    return $this->where('user_id', $userId)->exists();
}
}