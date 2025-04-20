<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            OrganizationsTableSeeder::class,
            AnnualConferencesTableSeeder::class,
            VolunteerOpportunitiesTableSeeder::class,
            ConferenceRegistrationsTableSeeder::class,
            OpportunityApplicationsTableSeeder::class,
            IdeasTableSeeder::class,
            CertificatesTableSeeder::class,
            SkillsInterestsTableSeeder::class,
        ]);
    }
}