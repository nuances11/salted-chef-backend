<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->assignRole(config('access.users.admin_role'));
        User::find(2)->assignRole(config('access.users.human_resource_manager_role'));
        User::find(3)->assignRole(config('access.users.human_resource_role'));
    }
}
