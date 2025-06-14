<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use App\Models\ManajemenPembelian;
use App\Models\ValidasiTransaksi;
use App\Models\StokMasuk; // PASTIKAN ANDA MENG-IMPORT MODEL STOK MASUK
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // PASTIKAN ANDA MENG-IMPORT DB UNTUK TRANSAKSI

class ManajemenPembelianController extends Controller
{
    /**
     * Menampilkan daftar pembelian berdasarkan role.
     */
    public function index()
    {
        if (Auth::user()->hasRole('kepala_gudang')) {
            
            // DIPERBAIKI: Menggunakan status 'disetujui' agar konsisten.
            // Pastikan status ini sama dengan yang Anda set di ValidasiTransaksiController.
            $pembelians = ManajemenPembelian::where('status', 'validated')->latest()->get();
            
            return view('kepala_gudang.manajemen_pembelian.index', compact('pembelians'));
        
        } else {

            $pembelians = ManajemenPembelian::with('user')->latest()->get();
            
            return view('kepala_admin.manajemen_pembelian.index', compact('pembelians'));
        }
    }

    public function create()
    {
        $pemasoks = Pemasok::all(); // ambil semua data pemasok
        return view('kepala_admin.manajemen_pembelian.create', compact('pemasoks'));
    }


    /**
     * Menyimpan data pembelian baru dan membuat pengajuan validasi.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pemasok' => 'required|exists:pemasoks,id_pemasok',
            'nama_pupuk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal_pembelian' => 'required|date',
        ]);

        $validatedData['id_user'] = Auth::id();
        $validatedData['status'] = 'pending';

        ManajemenPembelian::create($validatedData);

                


        return redirect()->route('kepala_admin.manajemen_pembelian.index')
                         ->with('success', 'Data pembelian berhasil ditambahkan dan dikirim untuk validasi.');
    }

    /**
     * FUNGSI BARU: Memproses pembelian yang disetujui menjadi stok masuk.
     */
    public function prosesStokMasuk(ManajemenPembelian $pembelian)
    {
        // Pastikan hanya pembelian yang statusnya 'disetujui' yang bisa diproses
        if ($pembelian->status !== 'validated') {
            return redirect()->back()->with('error', 'Hanya pembelian yang sudah disetujui yang dapat diproses.');
        }
        
        DB::beginTransaction();
        try {
            // 1. Buat catatan baru di tabel stok masuk
            StokMasuk::create([
                'id_pembelian' => $pembelian->id_pembelian,
                'nama_pupuk' => $pembelian->nama_pupuk,
                'jumlah' => $pembelian->jumlah,
                'satuan' => $pembelian->satuan,
                'pemasok' => $pembelian->pemasok,
                'tanggal_masuk' => now(),
                'id_user' => Auth::id(), // ID Kepala Gudang yang memproses
            ]);

            // 2. Update status pembelian menjadi 'selesai' agar tidak muncul lagi
            $pembelian->status = 'selesai';
            $pembelian->save();

            DB::commit();

            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('success', 'Pembelian berhasil diproses dan ditambahkan ke stok masuk.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // --- Metode lainnya untuk Kepala Admin ---

    public function edit(ManajemenPembelian $manajemenPembelian)
    {
        if ($manajemenPembelian->status !== 'pending') {
            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('error', 'Data yang sudah diproses tidak dapat diedit.');
        }
        return view('kepala_admin.manajemen_pembelian.edit', compact('manajemenPembelian'));
    }

    public function update(Request $request, ManajemenPembelian $manajemenPembelian)
    {
        if ($manajemenPembelian->status !== 'pending') {
            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('error', 'Data yang sudah diproses tidak dapat diperbarui.');
        }
        
        $validatedData = $request->validate([
            'nama_pupuk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'pemasok' => 'required|string|max:255',
            'tanggal_pembelian' => 'required|date',
        ]);

        $manajemenPembelian->update($validatedData);

        return redirect()->route('kepala_admin.manajemen_pembelian.index')
                         ->with('success', 'Data pembelian berhasil diperbarui.');
    }

    public function destroy(ManajemenPembelian $manajemenPembelian)
    {
        if ($manajemenPembelian->status !== 'pending') {
            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('error', 'Data yang sudah divalidasi atau ditolak tidak dapat dihapus.');
        }

        $manajemenPembelian->delete();

        return redirect()->route('kepala_admin.manajemen_pembelian.index')
                         ->with('success', 'Data pembelian berhasil dihapus.');
    }
}
