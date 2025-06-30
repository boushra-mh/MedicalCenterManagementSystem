<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permissions = [

            'admin' => [
                'manage_specialties',
                'manage_doctors',
            ],

            'doctor' => [
                'view_appointment',
            ],

            'user' => [
                'book_appointment',
            ],
        ];

        foreach ($permissions as $guard => $permissionList) {
            foreach ($permissionList as $permissionName) {
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => $guard,
                ]);
            }
        }

    }
}
