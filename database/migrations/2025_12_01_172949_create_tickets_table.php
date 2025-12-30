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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            // Terhubung ke Transaksi Induk
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');

            // Terhubung ke User & Event 
            $table->foreignId('user_id')->constrained('users', 'idUser')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');

            // Kode Unik per Tiket 
            $table->string('ticket_code')->unique();

            // Status tiket 
            $table->enum('status', ['Valid', 'Used'])->default('Valid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
