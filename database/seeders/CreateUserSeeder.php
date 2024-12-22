<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'user',
                'contact' => '09123456789',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => 0,
                'profile_image' => 'image/default-avatar.png',
            ],
            [
                'name' => 'agency',
                'contact' => '09123456789',
                'agency' => 'BFP',
                'email' => 'agency@gmail.com',
                'password' => bcrypt('password'),
                'role' => 1,
                'profile_image' => 'image/default-avatar.png',
            ],


            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 2,
                'profile_image' => 'image/default-avatar.png',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
