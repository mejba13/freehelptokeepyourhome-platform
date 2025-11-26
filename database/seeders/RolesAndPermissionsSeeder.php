<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Admin-only permissions
            'manage-users',
            'manage-roles',

            // Content management permissions (both admin and editor)
            'manage-pages',
            'manage-testimonials',
            'manage-hero',
            'manage-banners',
            'manage-ctas',
            'manage-forms',
            'manage-settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editorRole->syncPermissions([
            'manage-pages',
            'manage-testimonials',
            'manage-hero',
            'manage-banners',
            'manage-ctas',
            'manage-forms',
            'manage-settings',
        ]);
    }
}
