<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alamat;
use App\Models\User;
use Faker\Factory as Faker;

class AlamatSeeder extends Seeder{
    public function run()
    {
        $faker = Faker::create();
        $customers = User::where('role', 'customer')->pluck('id')->toArray();

        foreach ($customers as $customerId) {
            for ($i = 1; $i <= 2; $i++) {
                Alamat::create([
                    'id_customer' => $customerId,
                    'nama' => $faker->name,
                    'alamat' => $faker->streetAddress,
                    'kota' => $faker->city,
                    'nama_kota' => $faker->city,
                ]);
            }
        }
    }
}
