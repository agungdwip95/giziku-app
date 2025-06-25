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
        Schema::create('pengukuran_gizi', function (Blueprint $table) {
            $table->id(); // Kolom id: INT, PK, AI
            $table->foreignId('balita_id')->constrained('balita')->onDelete('cascade'); // Kolom balita_id: INT, FK ke balita.id
            $table->date('tanggal_ukur'); // Kolom tanggal_ukur: DATE
            $table->integer('usia_bulan'); // Kolom usia_bulan: INT
            $table->decimal('berat_badan', 4, 2); // Kolom berat_badan: DECIMAL(4,2)
            $table->decimal('tinggi_badan', 4, 2); // Kolom tinggi_badan: DECIMAL(4,2)
            $table->string('status_gizi', 50); // Kolom status_gizi: VARCHAR(50)
            $table->text('catatan')->nullable(); // Kolom catatan: TEXT, nullable
            $table->timestamps(); // Kolom created_at dan updated_at: TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_gizi');
    }
};