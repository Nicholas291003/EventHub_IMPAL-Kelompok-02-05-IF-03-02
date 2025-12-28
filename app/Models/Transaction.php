<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'event_id', 'jumlah_tiket', 'total_harga', 'status'];

    // Relasi: Transaksi milik User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'idUser');
    }

    // Relasi: Transaksi milik Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
