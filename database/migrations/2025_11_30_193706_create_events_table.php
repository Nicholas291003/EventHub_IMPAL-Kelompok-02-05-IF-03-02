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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // SKPL: namaEvent (Varchar 150)
            $table->string('namaEvent', 150);

            // SKPL: deskripsiEvent (Text)
            $table->text('deskripsiEvent');

            // SKPL: tanggalEvent (Date)
            $table->date('tanggalEvent');

            // SKPL: lokasiEvent (Varchar 200)
            $table->string('lokasiEvent', 200);

            // SKPL: hargaTiket (Double)
            $table->double('hargaTiket');

            // SKPL: statusTiket (Enum: Tersedia, Habis)
            $table->enum('statusTiket', ['Tersedia', 'Habis'])->default('Tersedia');

            // Tambahan: Stok tiket (penting untuk logika transaksi nanti)
            $table->integer('stokTiket')->default(0);

            // Gambar event (untuk tampilan frontend nanti)
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
