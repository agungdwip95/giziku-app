<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->text('alamat');
            $table->string('kota');
            $table->string('nama_kota');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alamats');
    }
};
