<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpportunityApplication;

class OpportunityApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        OpportunityApplication::create([
            'user_id' => 3,
            'opportunity_id' => 1,
            'status' => 'pending'
        ]);
    }
}