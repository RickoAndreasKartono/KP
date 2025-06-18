<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManajemenPembelian;
use App\Models\Pemasok;
use App\Models\ValidasiTransaksi;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManajemenPembelianController extends Controller
{
    /**
     * Daftar satuan yang tersedia
     */
    private function getSatuanOptions()
    {
        return [
            'Karung' => 'Karung (50 kg/karung)'
        ];
    }

    /**
     * Menampilkan daftar pembelian.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = ManajemenPembelian::with(['user', 'pemasok']);

        // Filter berdasarkan nama pupuk (PERBAIKAN: sesuai dengan form)
        if ($request->filled('nama_pupuk')) {
            $query->where('nama_pupuk', 'like', '%' . $request->nama_pupuk . '%');
        }

        // Filter berdasarkan pemasok (PERBAIKAN: sesuai dengan form)
        if ($request->filled('pemasok')) {
            $query->whereHas('pemasok', function($q) use ($request) {
                $q->where('nama_pemasok', 'like', '%' . $request->pemasok . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_pembelian', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_pembelian', '<=', $request->tanggal_sampai);
        }

        // Role-based filtering
        if ($user->hasRole('kepala_gudang')) {
            $query->where('status', 'validated');
        }
        
        // Mengurutkan berdasarkan aktivitas terakhir
        $query->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc');

        // PERBAIKAN: Tambahkan query parameters untuk pagination
        $pembelians = $query->paginate(10)->appends($request->query());

        // Menentukan view berdasarkan role
        if ($user->hasRole('owner') || $user->hasRole('kepala_gudang') || $user->hasRole('manager')) {
            return view('read.manajemen_pembelian', compact('pembelians'));
        } 
        
        return view('kepala_admin.manajemen_pembelian.index', compact('pembelians'));
    }

    /**
     * Memproses pembelian yang disetujui menjadi stok masuk.
     */
    public function prosesStokMasuk(ManajemenPembelian $pembelian)
    {
        if ($pembelian->status !== 'validated') {
            return redirect()->back()->with('error', 'Hanya pembelian yang sudah divalidasi yang dapat diproses.');
        }

        try {
            // Langsung gunakan jumlah karung tanpa konversi
            StokMasuk::create([
                'id_pembelian' => $pembelian->id_pembelian,
                'nama_pupuk' => $pembelian->nama_pupuk,
                'jumlah' => $pembelian->jumlah, // Sudah dalam karung
                'satuan' => 'Karung',
                'jumlah_original' => $pembelian->jumlah,
                'satuan_original' => $pembelian->satuan,
                'pemasok' => $pembelian->pemasok->nama_pemasok,
                'tanggal_masuk' => now(),
                'keterangan' => $pembelian->jumlah . ' karung (@ 50 kg/karung)',
                'id_user' => Auth::id(),
            ]);

            return redirect()->route('kepala_gudang.manajemen_pembelian.index')
                             ->with('success', 'Pembelian berhasil diproses dan ditambahkan ke stok masuk.');

        } catch (\Exception $e) {
            return redirect()->route('kepala_gudang.manajemen_pembelian.index')
                             ->with('error', 'Terjadi kesalahan saat memproses stok: ' . $e->getMessage());
        }
    }
    
    public function create()
    {
        $pemasokList = Pemasok::orderBy('nama_pemasok')->get();
        $satuanOptions = $this->getSatuanOptions();
        return view('kepala_admin.manajemen_pembelian.create', compact('pemasokList', 'satuanOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pupuk' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|in:Karung',
            'id_pemasok' => 'required|exists:pemasoks,id_pemasok',
            'tanggal_pembelian' => 'required|date',
        ]);
        
        $validatedData['id_user'] = Auth::id();
        $validatedData['status'] = 'pending';
        
        $pembelian = ManajemenPembelian::create($validatedData);
        
        if ($pembelian) {
            ValidasiTransaksi::create([
                'id_pembelian'      => $pembelian->id_pembelian,
                'status_validasi'   => 'pending',
                'id_user'           => Auth::id(),
                'tanggal_validasi'  => now(),
            ]);
        }
        
        return redirect()->route('kepala_admin.manajemen_pembelian.index')
                         ->with('success', 'Data pembelian berhasil ditambahkan dan dikirim untuk validasi.');
    }

    public function edit(ManajemenPembelian $manajemenPembelian)
    {
        if ($manajemenPembelian->status !== 'pending') {
            return redirect()->route('kepala_admin.manajemen_pembelian.index')
                             ->with('error', 'Data yang sudah diproses tidak dapat diedit.');
        }
        
        $pemasokList = Pemasok::orderBy('nama_pemasok')->get();
        $satuanOptions = $this->getSatuanOptions();
        
        return view('kepala_admin.manajemen_pembelian.edit', compact('manajemenPembelian', 'pemasokList', 'satuanOptions'));
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
            'satuan' => 'required|in:Karung',
            'id_pemasok' => 'required|exists:pemasoks,id_pemasok',
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