<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Produk;
use App\Models\User;
use Faker\Factory as Faker;

class RatingsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $produks = Produk::pluck('id')->toArray();
        $customers = User::where('role', 'customer')->pluck('id')->toArray();

        for ($i = 1; $i <= 15; $i++) {
            Rating::create([
                'id_produk' => $faker->randomElement($produks),
                'id_customer' => $faker->randomElement($customers),
                'rating' => $faker->numberBetween(1, 5),
                'review' => $faker->optional()->sentence,
            ]);
        }
    }
}
