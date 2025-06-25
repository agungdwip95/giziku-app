<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_seller')->constrained('users')->onDelete('cascade');
            $table->string('nama_kurir', 100);
            $table->decimal('total_harga', 15, 2);
            $table->boolean('review')->default(false);
            $table->enum('status', ['pending', 'proses', 'dikirim', 'selesai'])->default('pending');
            $table->timestamps();
        });

        Schema::create('pesanan_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('quantity')->unsigned()->default(1);
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_produk');
        Schema::dropIfExists('pesanans');
    }
};
