<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
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
        'date' => 'date'
    ];
}