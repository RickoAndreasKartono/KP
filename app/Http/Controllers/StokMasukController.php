<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupuk;
use App\Models\StokMasuk;
use Illuminate\Support\Facades\Auth;

class StokMasukController extends Controller
{
    public function create()
    {
        $pupuk = Pupuk::all();
        return view('owner.add_stok_masuk', compact('pupuk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pupuk' => 'required|exists:pupuk,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        // Simpan ke tabel stok_masuk
        StokMasuk::create([
            'id_pupuk' => $request->id_pupuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_user' => Auth::id(),
        ]);

        // Tambah stok pupuk
        $pupuk = Pupuk::find($request->id_pupuk);
        $pupuk->jumlah_tersedia += $request->jumlah_masuk;
        $pupuk->save();

        return redirect()->route('stok_masuk')->with('success', 'Data stok masuk berhasil ditambahkan.');
    }
}
