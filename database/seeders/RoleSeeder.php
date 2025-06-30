<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (UserRole::cases() as $roleEnum) {
            Role::updateOrCreate(
                ['name' => $roleEnum->value, 'guard_name' => $roleEnum->guard()]
            );
        }


        foreach (PermissionEnum::cases() as $permissionEnum) {
            $permission = Permission::updateOrCreate([
                'name' => $permissionEnum->value,
                'guard_name' => $permissionEnum->guard()
            ]);

            $role = Role::where('name', $permissionEnum->guard())
            ->where('guard_name', $permissionEnum->guard())->first();
            if ($role) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
