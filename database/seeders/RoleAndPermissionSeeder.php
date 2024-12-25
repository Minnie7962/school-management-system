<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'global' => [
                'view dashboard',
                'update profile',
            ],
            'admin' => [
                'manage students',
                'manage teachers',
                'manage attendance',
                'manage exams',
            ],
            'student' => [
                'view grades',
                'view attendance',
            ],
            'teacher' => [
                'record attendance',
                'record grades',
            ]
        ];

        foreach ($permissions as $group => $permissionList) {
            foreach ($permissionList as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        $roles = [
            'admin' => ['global', 'admin'],
            'student' => ['global', 'student'],
            'teacher' => ['global', 'teacher'],
            'owner' => ['global', 'admin']
        ];

        foreach ($roles as $roleName => $permissionGroups) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            
            $rolePermissions = [];
            foreach ($permissionGroups as $group) {
                $rolePermissions = array_merge(
                    $rolePermissions, 
                    $permissions[$group]
                );
            }

            $role->syncPermissions(
                Permission::whereIn('name', $rolePermissions)->get()
            );
        }
    }
}
