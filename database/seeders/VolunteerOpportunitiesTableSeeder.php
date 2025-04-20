<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VolunteerOpportunity;

class VolunteerOpportunitiesTableSeeder extends Seeder
{
    public function run()
    {
        VolunteerOpportunity::create([
            'organization_id' => 1,
            'title' => 'تطوع في دعم التعليم',
            'description' => 'فرصة تطوعية لدعم الطلاب في المناطق النائية',
            'volunteer_hours' => 20,
            'location' => 'عمان - جبل النصر',
            'category' => 'education',
            'city' => 'amman',
            'total_hours' => 100,
            'required_hours' => 10,
            'start_date' => '2023-10-01',
            'end_date' => '2023-12-31',
            'gender' => 'all',
            'total_volunteers' => 10,
            'current_volunteers' => 0,
            'status' => 'available',
            'total_participants' => 15, // قيمة للحقل المطلوب
            'current_participants' => 0,
            'working_days' => 'السبت,الأحد,الاثنين',
            'working_hours' => '9:00-15:00',
            'min_hours' => 2,
            'max_hours' => 6,
            'transport_available' => false
        
        ]);
    }
}