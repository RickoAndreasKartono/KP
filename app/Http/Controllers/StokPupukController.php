<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StokPupukController extends Controller
{
    public function stokPupuk()
{
    $pupuk = Stok::all(); // Ambil semua data stok pupuk
    return view('stok_pupuk.index', compact('pupuk'));
}

public function stokMasuk()
{
    // Hanya Owner dan Kepala Gudang yang bisa menambah stok masuk
    if (!in_array(auth()->user()->role, ['owner', 'kepala gudang'])) {
        return redirect('/dashboard');
    }

    // Logika untuk menambah stok masuk
    return view('stok_masuk.create');
}

public function stokKeluar()
{
    // Hanya Owner dan Kepala Gudang yang bisa mengelola stok keluar
    if (!in_array(auth()->user()->role, ['owner', 'kepala gudang'])) {
        return redirect('/dashboard');
    }

    // Logika untuk mengelola stok keluar
    return view('stok_keluar.create');
}

public function laporanStok()
{
    // Semua peran bisa melihat laporan stok
    $laporan = Stok::all(); // Ambil data laporan stok
    return view('laporan_stok.index', compact('laporan'));
}

}
