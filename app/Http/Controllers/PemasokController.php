<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok;

class PemasokController extends Controller
{
    /**
     * Tampilkan daftar pemasok dengan fitur pencarian berdasarkan nama_pemasok
     */
    public function index(Request $request)
    {
        $query = Pemasok::query();

        if ($search = $request->input('search')) {
            $query->where('nama_pemasok', 'like', "%$search%");
        }

        $pemasoks = $query->get();

        return view('kepala_admin.pemasok', [
            'pemasoks' => $pemasoks,
        ]);
    }

    /**
     * Tampilkan form tambah pemasok baru
     */
    public function create()
    {
        return view('kepala_admin.pemasok.add');
    }

    /**
     * Simpan data pemasok baru dengan validasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        Pemasok::create([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('kepala_admin.pemasok')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    /**
     * Hapus pemasok berdasarkan id
     */
    public function destroy($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $pemasok->delete();

        return redirect()->route('kepala_admin.pemasok')->with('success', 'Pemasok berhasil dihapus.');
    }
}

