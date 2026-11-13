<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => bcrypt('user123'),
        ]);
        $user->assignRole('user');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
        $admin->assignRole('admin');
    }
}
