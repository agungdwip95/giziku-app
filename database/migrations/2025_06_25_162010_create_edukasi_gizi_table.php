<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('edukasi_gizi', function (Blueprint $table) {
            $table->id(); // Kolom id: INT, PK, AI
            $table->string('judul', 150); // Kolom judul: VARCHAR(150)
            $table->text('konten'); // Kolom konten: TEXT
            $table->string('kategori', 50); // Kolom kategori: VARCHAR(50)
            $table->timestamps(); // Kolom created_at dan updated_at: TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi_gizi');
    }
};