<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $primaryKey = 'id_user';  // Pastikan menggunakan 'id_user'

    protected $fillable = [
        'nama_user', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function stokMasuks()
    {
        return $this->hasMany(StokMasuk::class, 'id_user');
    }

    public function stokKeluars()
    {
        return $this->hasMany(StokKeluar::class, 'id_user');
    }

    public function pembelians()
    {
        return $this->hasMany(ManajemenPembelian::class, 'id_user');
    }

    public function validasis()
    {
        return $this->hasMany(Validasi::class, 'id_user');
    }
}


