<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     * @var string
     */
    protected $table = 'pupuks';

    /**
     * Primary key untuk model.
     * @var string
     */
    protected $primaryKey = 'id_pupuk';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pupuk',
        'jumlah_tersedia',
        'lokasi_simpan',
    ];

    /**
     * Mendefinisikan relasi "hasMany" ke model StokMasuk.
     * Satu jenis pupuk bisa memiliki banyak riwayat stok masuk.
     */
    public function stokMasuks()
    {
        return $this->hasMany(StokMasuk::class, 'id_pupuk', 'id_pupuk');
    }

    /**
     * Anda juga bisa menambahkan relasi untuk stok keluar di sini nanti.
     *
     * public function stokKeluars()
     * {
     * return $this->hasMany(StokKeluar::class, 'id_pupuk', 'id_pupuk');
     * }
     */
}
