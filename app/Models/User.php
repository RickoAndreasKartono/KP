<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Nama tabel yang sesuai dengan database
    protected $table = 'users';
    

    // Primary key manual
    protected $primaryKey = 'id_user';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan saat mengambil data
    protected $hidden = [
        'password', // Agar password tidak ikut terlihat saat mengambil data
    ];
}
