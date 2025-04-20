<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id'=>1,'name' => 'admin', 'description' => 'مسؤول النظام'],
            ['id'=>2,'name' => 'organization', 'description' => 'منظمة'],
            ['id'=>3,'name' => 'volunteer', 'description' => 'متطوع'],
        
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}