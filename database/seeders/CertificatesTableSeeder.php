<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificatesTableSeeder extends Seeder
{
    public function run()
    {
        Certificate::create([
            'user_id' => 3,
            'volunteer_opportunities_id' => 1,
            'title' => 'شهادة مشاركة في دعم التعليم',
            'organization' => 'الجمعية الخيرية الأردنية',
            'image_path' => 'certificates/sample.jpg',
            'issue_date' => '2023-09-01'
        ]);
    }
}