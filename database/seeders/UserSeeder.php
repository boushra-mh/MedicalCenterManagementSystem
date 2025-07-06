<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Admin
        $admin = Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        // // Doctor
        // $doctor = Doctor::updateOrCreate(
        //     ['email' => 'doctor@example.com'],
        //     ['name' => 'Dr.Ahmed', 'password' => Hash::make('password')]
        // );
        // $doctor->assignRole('doctor');

        // User
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Patient_User', 'password' => Hash::make('password')]
        );
        $user->assignRole('user');

    }
}
