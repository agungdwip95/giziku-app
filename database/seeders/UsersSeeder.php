<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create 1 admin
        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'nama' => 'Admin User',
            'no_telp' => $faker->numerify('##########'), // 10-digit string
            'saldo' => null,
            'image' => null,
            'role' => 'admin',
        ]);

        // Create 3 customers
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'email' => "customer{$i}@example.com",
                'password' => Hash::make('password'),
                'nama' => $faker->name,
                'no_telp' => $faker->numerify('##########'),
                'saldo' => null,
                'image' => null,
                'role' => 'customer',
            ]);
        }

        // Create 2 sellers
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'email' => "seller{$i}@example.com",
                'password' => Hash::make('password'),
                'nama' => $faker->name,
                'no_telp' => $faker->numerify('##########'),
                'saldo' => $faker->randomFloat(2, 100, 1000),
                'image' => null,
                'role' => 'seller',
            ]);
        }
    }
}
