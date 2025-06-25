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
        Schema::create('balita', function (Blueprint $table) {
            $table->id(); // Kolom id: INT, PK, AI
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Kolom user_id: INT, FK ke users.id
            $table->string('nama', 100); // Kolom nama: VARCHAR(100)
            $table->date('tanggal_lahir'); // Kolom tanggal_lahir: DATE
            $table->enum('jenis_kelamin', ['L', 'P']); // Kolom jenis_kelamin: ENUM('L','P')
            $table->timestamps(); // Kolom created_at dan updated_at: TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};