<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin — created via seeder ONLY (no manual registration)
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@hirehub.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Default Recruiter
        User::create([
            'name'     => 'Demo Recruiter',
            'email'    => 'recruiter@hirehub.com',
            'password' => Hash::make('password'),
            'role'     => 'recruiter',
        ]);

        // Default Candidate
        User::create([
            'name'     => 'Demo Candidate',
            'email'    => 'candidate@hirehub.com',
            'password' => Hash::make('password'),
            'role'     => 'candidate',
        ]);
    }
}