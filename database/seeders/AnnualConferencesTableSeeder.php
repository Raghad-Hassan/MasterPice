<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnnualConference;

class AnnualConferencesTableSeeder extends Seeder
{
    public function run()
    {
        AnnualConference::create([
            'title' => 'المؤتمر السنوي للتطوع 2023',
            'description' => 'المؤتمر السنوي لجمعيات التطوع في الأردن',
            'location' => 'عمان - فندق جراند حياة',
            'date' => '2023-11-15',
            'expected_participants' => 300,
            'organizations_count' => 50,
            'activities' => 'جلسات حوارية، ورش عمل، معرض',
            'workshops' => 'إدارة المتطوعين، التخطيط للمبادرات'
        ]);
    }
}