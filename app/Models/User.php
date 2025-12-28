<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// SAYA SUDAH MENGHAPUS BARIS 'use Laravel\Sanctum\HasApiTokens;' DI SINI

class User extends Authenticatable
{
    // SAYA SUDAH MENGHAPUS 'HasApiTokens' DARI BARIS DI BAWAH INI
    use HasFactory, Notifiable;

    protected $primaryKey = 'idUser'; // Sesuai database Anda

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'idUser');
    }
}
