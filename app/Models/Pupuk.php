<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    protected $primaryKey = 'id_pupuk';
    protected $fillable = ['nama_pupuk', 'jumlah_tersedia', 'satuan'];

    public function stokMasuks()
    {
        return $this->hasMany(StokMasuk::class, 'id_pupuk');
    }

    public function stokKeluars()
    {
        return $this->hasMany(StokKeluar::class, 'id_pupuk');
    }

    public function laporanStok()
    {
        return $this->hasMany(LaporanStok::class, 'id_pupuk');
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailManajemenPembelian::class, 'id_pupuk');
    }
}
