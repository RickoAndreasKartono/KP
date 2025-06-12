<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupuk;
use App\Models\StokMasuk;
use Illuminate\Support\Facades\Auth;

class StokMasukController extends Controller
{
    /**
     * Menampilkan halaman daftar stok pupuk yang ada.
     * (resources/views/kepalagudang/stok_masuk.blade.php)
     */
    public function index()
    {
        // Method ini hanya perlu mengirim data semua pupuk untuk ditampilkan di daftar
        $allPupuk = Pupuk::orderBy('nama_pupuk')->get(); 
        
        return view('kepala_gudang.stok_masuk', compact('allPupuk'));
    }

    /**
     * Menampilkan halaman form untuk menambah data stok masuk baru.
     * (resources/views/kepalagudang/tambah_stok.blade.php)
     */
    public function create()
    {
        // Method ini juga perlu mengirim data pupuk untuk ditampilkan di dropdown form
        $allPupuk = Pupuk::orderBy('nama_pupuk')->get();

        return view('kepala_gudang.tambah_stok', compact('allPupuk'));
    }

    /**
     * Menyimpan data stok masuk baru dari form ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pupuk' => 'required|exists:pupuks,id_pupuk',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        // 1. Simpan ke tabel riwayat stok_masuk
        StokMasuk::create([
            'id_pupuk' => $request->id_pupuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_user' => Auth::id(),
        ]);

        // 2. Tambah jumlah stok di tabel pupuks
        $pupuk = Pupuk::find($request->id_pupuk);
        $pupuk->increment('jumlah_tersedia', $request->jumlah_masuk);

        // Redirect kembali ke halaman daftar stok dengan pesan sukses
        return redirect()->route('kepala_gudang.stok_masuk')->with('success', 'Data stok masuk berhasil ditambahkan.');
    }
}
