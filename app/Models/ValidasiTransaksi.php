<?php

// File: app/Models/ValidasiTransaksi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiTransaksi extends Model
{
    use HasFactory;

    /**
     * DIUBAH: Nama tabel disesuaikan agar cocok dengan file migrasi Anda.
     */
    protected $table = 'validasi_transaksis';

    /**
     * Primary key dari tabel.
     */
    protected $primaryKey = 'id_validasi';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'id_pembelian',
        'id_stok_keluar',
        'status_validasi',
        'id_user',
        'tanggal_validasi',
    ];

    /**
     * Relasi ke model ManajemenPembelian.
     */
    public function pembelian()
    {
        return $this->belongsTo(ManajemenPembelian::class, 'id_pembelian');
    }

    /**
     * Relasi ke model StokKeluar.
     */
    public function stokKeluar()
    {
        return $this->belongsTo(StokKeluar::class, 'id_stok_keluar');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
