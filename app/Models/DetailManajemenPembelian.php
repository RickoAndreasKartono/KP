<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailManajemenPembelian extends Model
{
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_pembelian', 'id_pupuk', 'jumlah', 'harga_satuan'];

    public function pembelian()
    {
        return $this->belongsTo(ManajemenPembelian::class, 'id_pembelian');
    }

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class, 'id_pupuk');
    }
}
