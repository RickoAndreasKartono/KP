<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $primaryKey = 'id_pemasok';
    protected $fillable = ['nama_pemasok', 'alamat', 'no_telp'];

    public function pembelians()
    {
        return $this->hasMany(ManajemenPembelian::class, 'id_pemasok');
    }
}
