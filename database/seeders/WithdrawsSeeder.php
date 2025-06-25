<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Withdraw;
use App\Models\User;
use Faker\Factory as Faker;

class WithdrawsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $sellers = User::where('role', 'seller')->pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            Withdraw::create([
                'id_seller' => $faker->randomElement($sellers),
                'total_saldo' => $faker->randomFloat(2, 50, 500),
                'status' => $faker->boolean,
            ]);
        }
    }
}
