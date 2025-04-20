<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Interest;

class SkillsInterestsTableSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            'التنظيم',
            'التدريس',
            'البرمجة',
            'التصميم',
            'الترجمة'
        ];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }

        $interests = [
            'التعليم',
            'الصحة',
            'البيئة',
            'التقنية',
            'الفنون'
        ];

        foreach ($interests as $interest) {
            Interest::create(['name' => $interest]);
        }
    }
}