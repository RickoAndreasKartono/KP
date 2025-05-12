<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function stokPupuk()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.stok_pupuk');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.stok_pupuk');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.stok_pupuk');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.stok_pupuk');
        } else {
           
        }
    }
    public function stokMasuk()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.stok_masuk');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.stok_masuk');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.stok_masuk');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.stok_masuk');
        } else {
            return redirect()->route('home'); // atau halaman default jika tidak ada role yang cocok
        }
    }

    public function stokKeluar()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.stok_keluar');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.stok_keluar');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.stok_keluar');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.stok_keluar');
        } else {
            return redirect()->route('home'); // atau halaman default jika tidak ada role yang cocok
        }
    }

    public function laporanStok()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.laporan_stok');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.laporan_stok');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.laporan_stok');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.laporan_stok');
        } else {
            return redirect()->route('home'); // atau halaman default jika tidak ada role yang cocok
        }
    }

    public function manajemenPembelian()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.manajemen_pembelian');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.manajemen_pembelian');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.manajemen_pembelian');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.manajemen_pembelian');
        } else {
            return redirect()->route('home'); // atau halaman default jika tidak ada role yang cocok
        }
    }

    public function validasiTransaksi()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.validasi_transaksi');
        } elseif (Auth::user()->role == 'manager') {
            return view('manager.validasi_transaksi');
        } elseif (Auth::user()->role == 'kepala_admin') {
            return view('kepala_admin.validasi_transaksi');
        } elseif (Auth::user()->role == 'kepala_gudang') {
            return view('kepala_gudang.validasi_transaksi');
        } else {
            return redirect()->route('home'); // atau halaman default jika tidak ada role yang cocok
        }
    }

    public function kelolaUser()
    {
        if (Auth::user()->role == 'owner') {
            return view('owner.kelola_user');
        } else {
            return redirect()->route('home'); // atau halaman default jika bukan 'owner'
        }
    }

    // public function dashboard()
    // {
    //     if(Auth::user()->role == 'owner')
    //     {
    //         return view('owner.stok_pupuk');
    //         return view('owner.stok_masuk');
    //         return view('owner.stok_keluar');
    //         return view('owner.laporan_stok');
    //         return view('owner.manajemen_pembelian');
    //         return view('owner.validasi_transaksi');
    //         return view('owner.kelola_user');
    //     }
    //     else if(Auth::user()->role == 'manager')
    //     {
    //         return view('manager.stok_pupuk');
    //     }
    //     else if(Auth::user()->role == 'kepala_admin')
    //     {
    //         return view('kepala_admin.stok_pupuk');
    //     }
    //     else if(Auth::user()->role == 'kepala_gudang')
    //     {
    //         return view('kepala_gudang.stok_pupuk');
    //     }
    //     else 
    //     {

    //     }
    // }
  
}
