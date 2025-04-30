<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdeasTableSeeder extends Seeder
{
    public function run()
    {
        $ideas = [
            [
                'user_id' => 3, // regular user
                'title' => 'Community Recycling Program',
                'field' => 'environment',
                'city' => 'amman',
                'description' => 'A program to encourage recycling in local neighborhoods with collection points and education',
                'idea_goals' => 'Reduce waste, increase recycling rates, educate community',
                'duration_days' => 90,
                'related_entities' => 'Local municipalities, schools, businesses',
                'status' => 'approved',
                'idea_duration' => 30,
                // 'idea_authorities' => 'Municipalities, environmental NGOs',

                
            ],
            [
                'user_id' => 3, // regular user
                'title' => 'Tech Literacy for Elderly',
                'field' => 'education',
                'city' => 'irbid',
                'description' => 'Workshops to teach elderly how to use smartphones and basic internet',
                'idea_goals' => 'Reduce digital divide, connect elderly with families, provide useful skills',
                'duration_days' => 60,
                'related_entities' => 'Community centers, telecom companies',
                'status' => 'pending',
                'idea_duration' => 45,
                // 'idea_authorities' => 'Community centers, local NGOs',
            ]
        ];

        DB::table('ideas')->insert($ideas);
    }
}