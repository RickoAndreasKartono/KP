<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     * Jika nama tabel Anda 'stok_masuks', baris ini tidak wajib,
     * tapi ini adalah praktik yang baik untuk mendefinisikannya secara eksplisit.
     * @var string
     */
    protected $table = 'stok_masuks';

    /**
     * Primary key untuk model.
     *
     * @var string
     */
    protected $primaryKey = 'id_stok_masuk';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Ini sudah benar dan cocok dengan controller Anda.
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pupuk',
        'jumlah_masuk',
        'satuan',
        'tanggal_masuk',
        'id_user'
    ];

    /**
     * Relasi ke model Pupuk.
     */
    public function pupuk()
    {
        
        return $this->belongsTo(Pupuk::class, 'id_pupuk', 'id_pupuk');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        // PERBAIKAN: Menambahkan parameter ketiga (ownerKey)
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }
}
