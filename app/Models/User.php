<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password',
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
