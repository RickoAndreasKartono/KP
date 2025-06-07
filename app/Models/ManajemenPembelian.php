<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManajemenPembelian extends Model
{
    protected $primaryKey = 'id_pembelian';
    protected $fillable = ['id_pemasok', 'total_harga', 'status', 'tanggal_pembelian', 'id_user'];

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
    {
        return $this->hasMany(DetailManajemenPembelian::class, 'id_pembelian');
    }

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'id_pembelian');
    }
}
