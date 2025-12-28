<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'namaEvent',
        'deskripsiEvent',
        'tanggalEvent',
        'lokasiEvent',
        'hargaTiket',
        'stokTiket',
        'statusTiket',
        'gambar'
    ];

    // Relasi: Satu Event punya banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'event_id');
    }
}
