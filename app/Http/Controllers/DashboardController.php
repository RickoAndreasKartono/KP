<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(Auth::user()->role == 'owner')
        {
            return view('owner.stok_pupuk');
        }
        else if(Auth::user()->role == 'manager')
        {
            return view('manager.stok_pupuk');
        }
        else if(Auth::user()->role == 'kepala_admin')
        {
            return view('kepala_admin.stok_pupuk');
        }
        else if(Auth::user()->role == 'kepala_gudang')
        {
            return view('kepala_gudang.stok_pupuk');
        }
        else 
        {

        }
    }
    
    // public function stokPupuk()
    // {
    //     return view('dashboard.stok_pupuk');
    // }

    // public function stokMasuk()
    // {
    //     return view('dashboard.stok_masuk');
    // }

    // public function stokKeluar()
    // {
    //     return view('dashboard.stok_keluar');
    // }

    // public function laporanStok()
    // {
    //     return view('dashboard.laporan_stok');
    // }

    // public function validasiTransaksi()
    // {
    //     return view('dashboard.validasi_transaksi');
    // }

    // public function manajemenPembelian()
    // {
    //     return view('dashboard.manajemen_pembelian');
    // }
}
