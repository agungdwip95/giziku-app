<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\User;
use App\Models\Kategori;
use Faker\Factory as Faker;

class ProduksSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $sellers = User::where('role', 'seller')->pluck('id')->toArray();
        $kategoris = Kategori::pluck('id')->toArray();

        // List of actual image filenames from your storage
        $imageFiles = [
            'products/product_12_17466222734_681b590e5b05.png',
            'products/product_13_1746623856_681b5bd7024f84.png',
            'products/product_14_17466225023_681b61ffca71a.png',
            'products/product_15_17466331201_681b7a2120750.png',
        ];

        for ($i = 1; $i <= 10; $i++) {
            // Cycle through the image files to assign them (repeat if necessary)
            $imagePaths = [
                $imageFiles[($i - 1) % count($imageFiles)], // Use modulo to cycle through available images
                $imageFiles[$i % count($imageFiles)],
            ];

            Produk::create([
                'id_seller' => $faker->randomElement($sellers),
                'id_kategori' => $faker->randomElement($kategoris),
                'nama' => $faker->word . ' Product',
                'deskripsi' => $faker->sentence,
                'harga' => $faker->randomFloat(2, 10, 500),
                'imagePath' => $imagePaths, // Store as array
                'jumlah_customer_rating' => $faker->numberBetween(0, 10),
                'total_rating' => $faker->numberBetween(0, 50),
            ]);
        }
    }
}
