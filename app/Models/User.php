<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable, HasFactory, SoftDeletes;

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

    public function hasRole(string $roleName): bool
    {
        // Fungsi ini akan membandingkan role user di database
        // dengan nama role yang kita cek.
        return $this->role === $roleName;
    }
}


