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
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => 0,
            ],

            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}