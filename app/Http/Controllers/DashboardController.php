<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function stokPupuk()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.stok_pupuk', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.stok_pupuk', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.stok_pupuk', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.stok_pupuk', $data);
        } else {
           
        }
    }
    public function stokMasuk()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            $data['stokMasuk'] = \App\Models\StokMasuk::with(['pupuk', 'user'])->latest()->get();
            return view('owner.stok_masuk', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.stok_masuk', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.stok_masuk', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.stok_masuk', $data);
        } else {
           
        }
    }

    public function stokKeluar()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.stok_keluar', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.stok_keluar', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.stok_keluar', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.stok_keluar', $data);
        } else {
           
        }
    }

    public function laporanStok()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.laporan_stok', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.laporan_stok', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.laporan_stok', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.laporan_stok', $data);
        } else {
           
        }
    }
    public function profileSettings()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.profile_settings', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.profile_settings', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.profile_settings', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.profile_settings', $data);
        } else {
           
        }
    }

    public function manajemenPembelian()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.manajemen_pembelian', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.manajemen_pembelian', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.manajemen_pembelian', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.manajemen_pembelian', $data);
        } else {
           
        }
    }

    public function validasiTransaksi()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.validasi_transaksi', $data);
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.validasi_transaksi', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.validasi_transaksi', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.validasi_transaksi', $data);
        } else {
           
        }
    }

    public function kelolaUser()
    {
        if (Auth::user()->role == 'owner') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('owner.kelola_user', $data);
             
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('manager.kelola_user', $data);
        } 
        elseif (Auth::user()->role == 'kepala_admin') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_admin.kelola_user', $data);
        } 
        elseif (Auth::user()->role == 'kepala_gudang') 
        {
            $data['getRecord'] = User::find(Auth::user()->id_user);
            return view('kepala_gudang.kelola_user', $data);
        } else {
           
        }
    }

    

  
}
