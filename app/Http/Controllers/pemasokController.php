<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasok; 
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    /**
     * Menampilkan daftar semua pemasok.
     */
    public function index()
    {
        $pemasokList = Pemasok::orderBy('nama_pemasok')->get();
        return view('kepala_admin.pemasok.index', compact('pemasokList'));
    }

    /**
     * Menampilkan form untuk menambah pemasok baru.
     */
    public function create()
    {
        $pemasokList = Pemasok::orderBy('nama_pemasok')->get();
    
        return view('kepala_admin.pemasok.create', compact('pemasokList'));
    }

    /**
     * Menyimpan pemasok baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi disesuaikan dengan skema database
        $validatedData = $request->validate([
            'nama_pemasok' => 'required|string|max:50|unique:pemasoks,nama_pemasok',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        Pemasok::create($validatedData);

        return redirect()->route('kepala_admin.pemasok.index')
                         ->with('success', 'Data pemasok baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pemasok.
     */
    public function edit(Pemasok $pemasok)
    {
        return view('kepala_admin.pemasok.edit', compact('pemasok'));
    }

    /**
     * Memperbarui data pemasok di database.
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        // Validasi disesuaikan dengan skema database
        $validatedData = $request->validate([
            'nama_pemasok' => 'required|string|max:50|unique:pemasoks,nama_pemasok,' . $pemasok->id_pemasok . ',id_pemasok',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        $pemasok->update($validatedData);

        return redirect()->route('kepala_admin.pemasok.index')
                         ->with('success', 'Data pemasok berhasil diperbarui.');
    }

    /**
     * Menghapus data pemasok dari database.
     */
    public function destroy(Pemasok $pemasok)
    {
        // Anda bisa menambahkan validasi di sini untuk mencegah penghapusan
        // jika pemasok sudah terkait dengan transaksi lain.
        
        $pemasok->delete();

        return redirect()->route('kepala_admin.pemasok.index')
                         ->with('success', 'Data pemasok berhasil dihapus.');
    }
}
