<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        /// Add the master administrator, user id of 1
        User::create([
            'first_name' => 'Ryan',
            'last_name' => 'Minner',
            'email' => 'admin@saltedchef.com',
            'password' => 'Password1',
            'email_verified_at' => now()
        ]);

        User::create([
            'first_name' => 'Human Resource',
            'last_name' => 'Manager',
            'email' => 'hrmanager@saltedchef.com',
            'password' => 'Password1',
            'email_verified_at' => now()
        ]);

        User::create([
            'first_name' => 'Human',
            'last_name' => 'Resource',
            'email' => 'hr@saltedchef.com',
            'password' => 'Password1',
            'email_verified_at' => now()
        ]);
    }
}
