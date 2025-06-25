<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PesanansSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $customers = User::where('role', 'customer')->pluck('id')->toArray();
        $sellers = User::where('role', 'seller')->pluck('id')->toArray();
        $produks = Produk::pluck('id')->toArray();

        for ($i = 1; $i <= 8; $i++) {
            $pesanan = Pesanan::create([
                'id_customer' => $faker->randomElement($customers),
                'id_seller' => $faker->randomElement($sellers),
                'nama_kurir' => $faker->randomElement(['JNE', 'J&T', 'SiCepat']),
                'total_harga' => $faker->randomFloat(2, 50, 1000),
                'review' => $faker->boolean,
                'status' => $faker->randomElement(['pending', 'proses', 'dikirim', 'selesai']),
            ]);

            $randomProduks = $faker->randomElements($produks, $faker->numberBetween(1, 3));
            foreach ($randomProduks as $produkId) {
                DB::table('pesanan_produk')->insert([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produkId,
                    'quantity' => $faker->numberBetween(1, 5),
                    'harga' => $faker->randomFloat(2, 10, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
