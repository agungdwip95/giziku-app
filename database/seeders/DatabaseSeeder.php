<?php

use Database\Seeders\AlamatSeeder;
use Database\Seeders\KategorisSeeder;
use Database\Seeders\PesanansSeeder;
use Database\Seeders\ProduksSeeder;
use Database\Seeders\RatingsSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\WithdrawsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            KategorisSeeder::class,
            ProduksSeeder::class,
            RatingsSeeder::class,
            AlamatSeeder::class,
            PesanansSeeder::class,
            WithdrawsSeeder::class,
        ]);
    }
}
