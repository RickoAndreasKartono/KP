<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $primaryKey = 'id_validasi';
    protected $fillable = ['id_pembelian', 'id_stok_keluar', 'status_validasi', 'id_user', 'tanggal_validasi'];

    public function pembelian()
    {
        return $this->belongsTo(ManajemenPembelian::class, 'id_pembelian');
    }

    public function stokKeluar()
    {
        return $this->belongsTo(StokKeluar::class, 'id_stok_keluar');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
