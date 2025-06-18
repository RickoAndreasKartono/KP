<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokKeluarController extends Controller
{
    /**
     * FUNGSI BARU: Menyiapkan daftar lokasi tujuan
     */
    private function getLokasiTujuan()
    {
        return [
            'Desa Perajin',
            'Desa Air Kumbang',
            'Desa Teluk Tenggirik'
        ];
    }

    public function index()
    {
        $userRole = Auth::user()->role;

        if ($userRole == 'kepala_gudang') {
            $stokKeluarHistory = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar')->get();
            return view('kepala_gudang.stok_keluar.index', compact('stokKeluarHistory'));
        
        } elseif (in_array($userRole, ['owner', 'manager', 'kepala_admin'])) {
            $stokKeluarHistory = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar')->get();
            return view('read.stok_keluar', compact('stokKeluarHistory'));
        
        } else {
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
        
        // PERBAIKAN: Mengambil daftar lokasi dan mengirimkannya ke view
        $lokasiTujuan = $this->getLokasiTujuan();

        return view('kepala_gudang.stok_keluar.create', compact('daftarPupuk', 'lokasiTujuan'));
    }

    /**
     * Menyimpan data stok keluar baru.
     */
    public function store(Request $request)
    {
        // Mengambil daftar lokasi untuk validasi
        $lokasiTujuan = $this->getLokasiTujuan();

        $validatedData = $request->validate([
            'id_pupuk' => 'required|exists:pupuks,id_pupuk',
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            // PERBAIKAN: Validasi 'tujuan' harus salah satu dari daftar lokasi
            'tujuan' => 'required|in:' . implode(',', $lokasiTujuan),
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
        // PERBAIKAN: Kirim juga daftar lokasi ke form edit
        $lokasiTujuan = $this->getLokasiTujuan();
        return view('kepala_gudang.stok_keluar.edit', compact('stokKeluar', 'lokasiTujuan'));
    }

    /**
     * Menyimpan perubahan dari form edit.
     */
    public function update(Request $request, StokKeluar $stokKeluar)
    {
        $lokasiTujuan = $this->getLokasiTujuan();

        $validatedData = $request->validate([
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan' => 'required|in:' . implode(',', $lokasiTujuan),
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
