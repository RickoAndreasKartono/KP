<?php

namespace App\Http\Controllers; // Sesuaikan namespace jika controller Anda ada di folder lain

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokKeluarController extends Controller
{
    /**
     * Fungsi ini akan menampilkan halaman yang berbeda berdasarkan role pengguna.
     */
    public function index()
    {
        $userRole = Auth::user()->role;

        if ($userRole == 'kepala_gudang') {
            // UNTUK KEPALA GUDANG: Tampilkan riwayat dengan tombol aksi CRUD.
            $stokKeluarHistory = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar')->get();
            return view('kepala_gudang.stok_keluar.index', compact('stokKeluarHistory'));
        
        } elseif (in_array($userRole, ['owner', 'manager', 'kepala_admin'])) {
            // UNTUK ROLE LAIN: Tampilkan riwayat yang sama dalam mode read-only.
            $stokKeluarHistory = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar')->get();
            
            // DIPERBAIKI: Mengarahkan ke view baru 'read.stok_keluar' sesuai dengan file yang Anda buat.
            return view('read.stok_keluar', compact('stokKeluarHistory'));
        
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
     * Menampilkan form untuk mencatat stok keluar baru.
     */
    public function create()
    {
        $daftarPupuk = Pupuk::where('jumlah_tersedia', '>', 0)->orderBy('nama_pupuk')->get();
        return view('kepala_gudang.stok_keluar.create', compact('daftarPupuk'));
    }

    /**
     * Menyimpan data stok keluar baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pupuk' => 'required|exists:pupuks,id_pupuk',
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan' => 'required|string|max:255',
        ]);

        $pupuk = Pupuk::findOrFail($validatedData['id_pupuk']);

        if ($pupuk->jumlah_tersedia < $validatedData['jumlah_keluar']) {
            return redirect()->back()
                ->with('error', 'Gagal! Stok pupuk ' . $pupuk->nama_pupuk . ' hanya tersisa ' . $pupuk->jumlah_tersedia . ' ' . $pupuk->satuan . '.')
                ->withInput();
        }

        StokKeluar::create([
            'id_pupuk' => $validatedData['id_pupuk'],
            'jumlah_keluar' => $validatedData['jumlah_keluar'],
            'tanggal_keluar' => $validatedData['tanggal_keluar'],
            'tujuan' => $validatedData['tujuan'],
            'id_user' => Auth::id(),
        ]);

        $pupuk->decrement('jumlah_tersedia', $validatedData['jumlah_keluar']);

        return redirect()->route('kepala_gudang.stok_keluar.index')->with('success', 'Data stok keluar berhasil dicatat.');
    }

    /**
     * Menampilkan form edit stok keluar.
     */
    public function edit(StokKeluar $stokKeluar)
    {
        return view('kepala_gudang.stok_keluar.edit', compact('stokKeluar'));
    }

    /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, StokKeluar $stokKeluar)
    {
        $validatedData = $request->validate([
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan' => 'required|string|max:255',
        ]);

        $pupuk = $stokKeluar->pupuk;
        $jumlahLama = $stokKeluar->jumlah_keluar;
        $jumlahBaru = $validatedData['jumlah_keluar'];
        $selisih = $jumlahBaru - $jumlahLama;

        if (($pupuk->jumlah_tersedia + $jumlahLama) < $jumlahBaru) {
            return redirect()->back()
                ->with('error', 'Gagal! Stok tidak mencukupi untuk jumlah baru.')
                ->withInput();
        }
        
        $pupuk->decrement('jumlah_tersedia', $selisih);
        $stokKeluar->update($validatedData);

        return redirect()->route('kepala_gudang.stok_keluar.index')->with('success', 'Data stok keluar berhasil diperbarui.');
    }

    /**
     * Menghapus data stok keluar.
     */
    public function destroy(StokKeluar $stokKeluar)
    {
        $stokKeluar->pupuk->increment('jumlah_tersedia', $stokKeluar->jumlah_keluar);
        $stokKeluar->delete();
        return redirect()->route('kepala_gudang.stok_keluar.index')->with('success', 'Data stok keluar berhasil dihapus dan stok telah dikembalikan.');
    }
}
