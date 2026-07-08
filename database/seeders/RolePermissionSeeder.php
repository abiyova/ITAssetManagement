<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage-dashboard',
            'manage-users',
            'manage-categories',
            'manage-brands',
            'manage-vendors',
            'manage-departments',
            'manage-locations',
            'manage-employees',
            'manage-assets',
            'manage-assignments',
            'manage-transfers',
            'manage-maintenances',
            'manage-attachments',
            'manage-reports',
            'manage-audit-logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo($permissions);

        $itStaff = Role::firstOrCreate(['name' => 'it-staff', 'guard_name' => 'web']);
        $itStaff->givePermissionTo([
            'manage-dashboard', 'manage-assets', 'manage-assignments',
            'manage-transfers', 'manage-maintenances', 'manage-attachments', 'manage-reports',
        ]);

        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'manage-dashboard', 'manage-assets', 'manage-assignments',
            'manage-transfers', 'manage-maintenances', 'manage-reports',
        ]);

        $auditor = Role::firstOrCreate(['name' => 'auditor', 'guard_name' => 'web']);
        $auditor->givePermissionTo([
            'manage-dashboard', 'manage-reports', 'manage-audit-logs',
        ]);
    }
}
