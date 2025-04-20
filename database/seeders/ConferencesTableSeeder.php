<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConferencesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('conferences')->insert([
            [
                'date' => Carbon::now()->toDateString(),
                'location' => 'Amman, Jordan',
                'volunteers_count' => 50,
                'organizations_count' => 10,
                'workshops' => 'Workshop 1: Leadership, Workshop 2: Technology',
                'goals' => 'Enhance collaboration, share knowledge, and empower communities.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date' => Carbon::now()->addDays(7)->toDateString(),
                'location' => 'Dead Sea, Jordan',
                'volunteers_count' => 100,
                'organizations_count' => 20,
                'workshops' => 'Workshop 1: Innovation, Workshop 2: Sustainability',
                'goals' => 'Promote innovation, discuss sustainability practices, and build partnerships.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // يمكنك إضافة المزيد من البيانات هنا حسب الحاجة
        ]);
    }
}
