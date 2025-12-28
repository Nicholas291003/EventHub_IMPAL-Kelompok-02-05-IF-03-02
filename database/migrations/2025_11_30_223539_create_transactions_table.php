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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Pembeli)
            $table->foreignId('user_id')->constrained('users', 'idUser')->onDelete('cascade');

            // Relasi ke Event (Yang dibeli)
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');

            // Detail Transaksi
            $table->integer('jumlah_tiket');
            $table->double('total_harga');
            $table->enum('status', ['Lunas', 'Batal'])->default('Lunas'); // Simulasi langsung lunas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
