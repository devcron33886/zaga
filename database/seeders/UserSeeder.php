<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Jacques MBABAZI',
                'email' => 'mbabazijacques@gmail.com',
                'is_admin' => true,
                'email_verified_at' => now(),
                'password' => bcrypt('Imma@1995$'),

            ],
            [
                'name' => 'Paccy KWITONDA',
                'email' => 'bar@gmail.com',
                'is_admin' => false,
                'email_verified_at' => now(),
                'password' => bcrypt('Imma@1995$'),

            ],
            [
                'name' => 'Miguel Almiron',
                'email' => 'sauna@gmail.com',
                'is_admin' => false,
                'email_verified_at' => now(),
                'password' => bcrypt('Imma@1995$'),

            ],



        ];
        User::insert($users);
    }
}
