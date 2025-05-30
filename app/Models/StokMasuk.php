<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    protected $primaryKey = 'id_stok_masuk';
    protected $fillable = ['id_pupuk', 'jumlah_masuk', 'tanggal_masuk', 'id_user'];

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class, 'id_pupuk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
