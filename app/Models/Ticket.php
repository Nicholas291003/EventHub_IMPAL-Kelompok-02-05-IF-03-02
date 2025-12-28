<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['transaction_id', 'user_id', 'event_id', 'ticket_code', 'status'];

    // Relasi ke Event (Untuk ambil Nama, Lokasi, Tanggal)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
