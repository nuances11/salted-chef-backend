<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Create Roles
        Role::create([
            'name' => config('access.users.admin_role'),
            'readable_name' => config('access.users.admin_role_readable_name')
        ]);
        Role::create([
            'name' => config('access.users.human_resource_manager_role'),
            'readable_name' => config('access.users.human_resource_manager_role_readable_name')
        ]);
        Role::create([
            'name' => config('access.users.human_resource_role'),
            'readable_name' => config('access.users.human_resource_role_readable_name')
        ]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        // $user->givePermissionTo('view backend');
    }
}
