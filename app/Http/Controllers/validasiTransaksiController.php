<?php

// File: app/Http/Controllers/ValidasiTransaksiController.php

namespace App\Http\Controllers;

use App\Models\ManajemenPembelian; // DI-TAMBAHKAN: Gunakan model ManajemenPembelian
use App\Models\ValidasiTransaksi;
use Illuminate\Http\Request;

class ValidasiTransaksiController extends Controller
{
    public function index()
    {
        $validations = ValidasiTransaksi::with(['pembelian', 'stokKeluar', 'user'])
            ->orderByRaw("FIELD(status_validasi, 'pending', 'validated', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manager.validasi_transaksi.index', compact('validations'));
    }

    

    /**
     * Menyetujui pengajuan validasi dan memberi umpan balik.
     */
    public function approve($id_validasi)
    {
        $validasi = ValidasiTransaksi::findOrFail($id_validasi);
        $validasi->status_validasi = 'validated';
        $validasi->save();

        // DI-TAMBAHKAN: Update status pada data pembelian asli
        if ($validasi->id_pembelian) {
            $pembelian = ManajemenPembelian::find($validasi->id_pembelian);
            if ($pembelian) {
                $pembelian->status = 'validated'; // Sesuaikan dengan nilai di migrasi Anda
                $pembelian->save();
            }
        }

        return redirect()->route('manager.validasi_transaksi.index')->with('success', 'Pengajuan berhasil divalidasi.');
    }

    /**
     * Menolak pengajuan validasi dan memberi umpan balik.
     */
    public function reject($id_validasi)
    {
        $validasi = ValidasiTransaksi::findOrFail($id_validasi);
        $validasi->status_validasi = 'rejected';
        $validasi->save();

        // DI-TAMBAHKAN: Update status pada data pembelian asli
        if ($validasi->id_pembelian) {
            $pembelian = ManajemenPembelian::find($validasi->id_pembelian);
            if ($pembelian) {
                $pembelian->status = 'rejected'; // Sesuaikan dengan nilai di migrasi Anda
                $pembelian->save();
            }
        }

        return redirect()->route('manager.validasi_transaksi.index')->with('success', 'Pengajuan telah ditolak.');
    }
}
