<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    protected $primaryKey = 'id_stok_keluar';
    protected $fillable = ['id_pupuk', 'jumlah_keluar', 'tujuan', 'tanggal_keluar', 'id_user'];

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class, 'id_pupuk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'id_stok_keluar');
    }
}
