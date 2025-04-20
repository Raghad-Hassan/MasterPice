<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SdgGoalsTableSeeder extends Seeder
{
    public function run()
    {
        $goals = [
            ['name' => 'No Poverty', 'image' => 'sdg1.png'],
            ['name' => 'Zero Hunger', 'image' => 'sdg2.png'],
            ['name' => 'Good Health and Well-being', 'image' => 'sdg3.png'],
            ['name' => 'Quality Education', 'image' => 'sdg4.png'],
            ['name' => 'Gender Equality', 'image' => 'sdg5.png'],
            ['name' => 'Clean Water and Sanitation', 'image' => 'sdg6.png'],
            ['name' => 'Affordable and Clean Energy', 'image' => 'sdg7.png'],
            ['name' => 'Decent Work and Economic Growth', 'image' => 'sdg8.png'],
            ['name' => 'Industry, Innovation and Infrastructure', 'image' => 'sdg9.png'],
            ['name' => 'Reduced Inequalities', 'image' => 'sdg10.png'],
            ['name' => 'Sustainable Cities and Communities', 'image' => 'sdg11.png'],
            ['name' => 'Responsible Consumption and Production', 'image' => 'sdg12.png'],
            ['name' => 'Climate Action', 'image' => 'sdg13.png'],
            ['name' => 'Life Below Water', 'image' => 'sdg14.png'],
            ['name' => 'Life on Land', 'image' => 'sdg15.png'],
            ['name' => 'Peace, Justice and Strong Institutions', 'image' => 'sdg16.png'],
            ['name' => 'Partnerships for the Goals', 'image' => 'sdg17.png']
        ];

        DB::table('sdg_goals')->insert($goals);
    }
}