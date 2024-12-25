<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupRolesAndPermissions extends Command
{
    protected $signature = 'permissions:setup';
    protected $description = 'Setup initial roles and permissions';

    public function handle()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'admin' => [
                'view dashboard',
                'manage students',
                'manage teachers',
                'manage attendance',
                'manage exams',
            ],
            'student' => [
                'view dashboard',
                'view grades',
                'view attendance',
                'update profile',
            ],
            'teacher' => [
                'view dashboard',
                'manage class attendance',
                'record grades',
                'view student profiles',
            ],
            'owner' => [
                'view dashboard',
                'manage system settings',
                'view financial reports',
            ]
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }

        $this->info('Roles and permissions setup successfully!');
    }
}
