<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Administrator',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$NHBMXJhjddkIfG4dxS7BGemUVumsayvb1Za7jyH/CRFHJjEiYfiNC',
                'remember_token' => null,
                'approved'       => 1,
                'phone'          => '0700000000',
            ],
            [
                'id'             => 2,
                'name'           => 'Seller Name',
                'email'          => 'seller@mail.com',
                'password'       => '$2y$10$NHBMXJhjddkIfG4dxS7BGemUVumsayvb1Za7jyH/CRFHJjEiYfiNC',
                'remember_token' => null,
                'approved'       => 2,
                'phone'          => '0700000001',
            ],
            [
                'id'             => 3,
                'name'           => 'Buyer Name',
                'email'          => 'buyer@mail.com',
                'password'       => '$2y$10$NHBMXJhjddkIfG4dxS7BGemUVumsayvb1Za7jyH/CRFHJjEiYfiNC',
                'remember_token' => null,
                'approved'       => 3,
                'phone'          => '0700000002',
            ],
        ];

        User::insert($users);
    }
}