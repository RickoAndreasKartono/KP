<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanStok extends Model
{
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_pupuk', 'periode', 'total_masuk', 'total_keluar', 'stok_akhir'];

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class, 'id_pupuk');
    }
}
