<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pupuk';

    protected $fillable = [
        'nama_pupuk',
        'satuan',
        'jumlah_tersedia',
    ];

    /**
     * Relasi ke riwayat stok masuk.
     */
    public function stokMasuks()
    {
        return $this->hasMany(StokMasuk::class, 'id_pupuk', 'id_pupuk');
    }

    /**
     * DITAMBAHKAN: Relasi ke riwayat stok keluar.
     */
    public function stokKeluars()
    {
        return $this->hasMany(StokKeluar::class, 'id_pupuk', 'id_pupuk');
    }
}
