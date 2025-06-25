<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategorisSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Elektronik', 'Fashion', 'Makanan', 'Otomotif'];

        foreach ($categories as $category) {
            Kategori::create([
                'nama' => $category,
            ]);
        }
    }
}
