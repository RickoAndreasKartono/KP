<?php

namespace App\Http\Controllers; // Sesuaikan namespace jika controller Anda ada di folder lain

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokMasukController extends Controller
{
    /**
     * Fungsi ini akan menampilkan halaman yang berbeda berdasarkan role pengguna.
     */
    public function index()
    {
        $userRole = Auth::user()->role;

        if ($userRole == 'kepala_gudang') {
            // UNTUK KEPALA GUDANG: Tampilkan daftar master pupuk untuk dikelola (CRUD)
            $daftarPupuk = Pupuk::orderBy('nama_pupuk')->get();
            return view('kepala_gudang.stok_masuk.index', compact('daftarPupuk'));
        
        } elseif (in_array($userRole, ['owner', 'manager', 'kepala_admin'])) {
            // UNTUK ROLE LAIN: Tampilkan riwayat stok masuk (Read-Only)
            $stokMasukHistory = StokMasuk::with(['user', 'pupuk'])->latest('tanggal_masuk')->get();
            // Arahkan ke view bersama (shared) untuk riwayat
            return view('shared.stok_masuk.riwayat', compact('stokMasukHistory'));
        
        } else {
            // Fallback jika ada role lain yang tidak terdefinisi
            abort(403, 'Akses Ditolak.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FUNGSI-FUNGSI DI BAWAH INI KHUSUS UNTUK KEPALA GUDANG
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan form untuk membuat data master pupuk baru.
     */
    public function create()
    {
        return view('kepala_gudang.stok_masuk.create');
    }

    /**
     * Menyimpan data pupuk baru beserta stok awalnya.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form, TERMASUK 'satuan'
        $validatedData = $request->validate([
            'nama_pupuk' => 'required|string|max:255|unique:pupuks,nama_pupuk',
            'jumlah_masuk' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50', // PASTIKAN VALIDASI INI ADA
            'tanggal_masuk' => 'required|date',
        ]);

        // 2. Buat data master pupuk baru
        $pupuk = Pupuk::create([
            'nama_pupuk' => $validatedData['nama_pupuk'],
            'satuan' => $validatedData['satuan'], // PASTIKAN 'satuan' DISERTAKAN DI SINI
            'jumlah_tersedia' => $validatedData['jumlah_masuk'],
        ]);

        // 3. Jika ada stok awal, catat di riwayat stok_masuks
        if ($validatedData['jumlah_masuk'] > 0) {
            StokMasuk::create([
                'id_pupuk' => $pupuk->id_pupuk,
                'jumlah_masuk' => $validatedData['jumlah_masuk'],
                'tanggal_masuk' => $validatedData['tanggal_masuk'],
                'id_user' => Auth::id(),
            ]);
        }

        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Pupuk baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk data master pupuk.
     */
    public function edit(Pupuk $pupuk)
    {
        return view('kepala_gudang.stok_masuk.edit', compact('pupuk'));
    }

    /**
     * Menyimpan perubahan data master pupuk.
     */
    public function update(Request $request, Pupuk $pupuk)
    {
        $validatedData = $request->validate([
            'nama_pupuk' => 'required|string|max:255|unique:pupuks,nama_pupuk,' . $pupuk->id_pupuk . ',id_pupuk',
            'satuan' => 'required|string|max:50',
            'jumlah_tersedia' => 'required|integer|min:0',
        ]);
        
        $pupuk->update($validatedData);
        
        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Data master pupuk berhasil diperbarui.');
    }

    /**
     * Menghapus data master pupuk.
     */
    public function destroy(Pupuk $pupuk)
    {
        $pupuk->delete();
        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Data pupuk berhasil dihapus.');
    }
}
