<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConferenceRegistration;

class ConferenceRegistrationsTableSeeder extends Seeder
{
    public function run()
    {
        ConferenceRegistration::create([
            'user_id' => 3,
            'conference_id' => 1,
            'full_name' => 'متطوع متحمس',
            'email' => 'volunteer@example.com',
            'phone' => '0798765432',
            'interest_field' => 'education',
            'city' => 'amman',
            'previous_experience' => true,
            'skills' => ['organization', 'management'],
            'participation_reason' => 'أرغب في تطوير مهاراتي في العمل التطوعي'
        ]);
    }
}