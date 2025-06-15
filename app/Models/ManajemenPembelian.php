<?php

// File: app/Models/ManajemenPembelian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\PemasokController;

class ManajemenPembelian extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'manajemen_pembelians';

    /**
     * Primary key untuk tabel ini.
     * @var string
     */
    protected $primaryKey = 'id_pembelian';

    /**
     * Kolom yang bisa diisi secara massal (mass assignable).
     * @var array
     */

    protected $fillable = [
        'id_pemasok', 'nama_pupuk', 'jumlah', 'satuan',
        'tanggal_pembelian', 'id_user', 'status'
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Ini untuk mengetahui user mana (Kepala Admin) yang menginput pembelian.
     */
    public function user(): BelongsTo
    {
        // Perhatikan 'id_user' sebagai foreign key dan 'id_user' sebagai owner key di tabel users.
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'id_pemasok');
    }

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'id_pembelian');
    }


}
