<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationsTableSeeder extends Seeder
{
    public function run()
    {
        Organization::create([
            'user_id' => 2, // Organization User
            'organization_name' => 'الجمعية الخيرية الأردنية',
            'first_name' => 'مدير',
            'last_name' => 'الجمعية',
            'phone' => '0791234567',
            'email' => 'org1@example.com',
            'description' => 'جمعية خيرية تعمل في مجال التعليم',
            'password' => bcrypt('password'),
            'governorate' => 'Amman',
            'sector' => 'NGO',
            'national_id' => '123456789',
            'volunteer_services' => 'yes',
            'volunteer_type' => 'تعليمي'
        ]);
    }
}