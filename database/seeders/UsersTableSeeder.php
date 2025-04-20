<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ], [
            'description' => 'System administrator with full permissions',
        ]);
        
        $organizationRole = Role::firstOrCreate([
            'name' => 'organization',
        ], [
            'description' => 'User representing an organization',
        ]);

         $volunteerRole = Role::firstOrCreate([
            'name' => 'volunteer',
        ], [
            'description' => 'User representing a volunteer',
        ]);

        // مسؤول النظام
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'gender' => 'male',
            'governorate' => 'Amman',
            'birth_date' => '1990-01-01',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id, // Admin
        ]);

        // منظمة
        User::create([
            'first_name' => 'Organization',
            'last_name' => 'User',
            'email' => 'org@example.com',
            'phone' => '1234567891',
            'gender' => 'female',
            'governorate' => 'Irbid',
            'birth_date' => '1995-05-15',
            'password' => Hash::make('password'),
            'role_id' => $organizationRole->id, // Organization
        ]);

        // متطوع
        User::create([
            'first_name' => 'Volunteer',
            'last_name' => 'User',
            'email' => 'volunteer@example.com',
            'phone' => '1234567892',
            'gender' => 'male',
            'governorate' => 'Zarqa',
            'birth_date' => '1998-10-20',
            'password' => Hash::make('password'),
            'role_id' => $volunteerRole->id, // Volunteer
        ]);
    }
}