<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // Sesuaikan nama tabel
    protected $primaryKey = 'id_user'; // Primary key manual

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
