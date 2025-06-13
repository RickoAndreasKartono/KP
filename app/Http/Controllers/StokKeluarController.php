<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StokKeluarController extends Controller
{
    /**
     * Menampilkan halaman riwayat stok keluar.
     */
    public function index()
    {
        $stokKeluarHistory = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar')->get();
        return view('kepala_gudang.stok_keluar.index', compact('stokKeluarHistory'));
    }

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
        // DIUBAH: Validasi disesuaikan menjadi 'lokasi'
        $validatedData = $request->validate([
            'id_pupuk' => 'required|exists:pupuks,id_pupuk',
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'tujuan' => 'required|string|max:255', // Disesuaikan dengan database
        ]);

        $pupuk = Pupuk::findOrFail($validatedData['id_pupuk']);

        if ($pupuk->jumlah_tersedia < $validatedData['jumlah_keluar']) {
            return redirect()->back()
                ->with('error', 'Gagal! Stok pupuk ' . $pupuk->nama_pupuk . ' hanya tersisa ' . $pupuk->jumlah_tersedia . ' ' . $pupuk->satuan . '.')
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // DIUBAH: Menyimpan 'lokasi'
            StokKeluar::create([
                'id_pupuk' => $pupuk->id_pupuk,
                'jumlah_keluar' => $validatedData['jumlah_keluar'],
                'tanggal_keluar' => $validatedData['tanggal_keluar'],
                'tujuan' => $validatedData['tujuan'], // Menggunakan field 'lokasi'
                'id_user' => Auth::id(),
            ]);

            $pupuk->decrement('jumlah_tersedia', $validatedData['jumlah_keluar']);

            DB::commit();

            return redirect()->route('kepala_gudang.stok_keluar.index')->with('success', 'Data stok keluar berhasil dicatat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // ... (Method edit dan update juga disesuaikan jika ada)
}
