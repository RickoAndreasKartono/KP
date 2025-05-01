<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';

    protected $fillable = ['nama_user', 'email', 'password', 'role'];

    public function stokMasuk() {
        return $this->hasMany(StokMasuk::class, 'id_user');
    }

    public function stokKeluar() {
        return $this->hasMany(StokKeluar::class, 'id_user');
    }

    public function pembelian() {
        return $this->hasMany(ManajemenPembelian::class, 'id_user');
    }

    public function validasi() {
        return $this->hasMany(ValidasiTransaksi::class, 'id_user');
    }
}
