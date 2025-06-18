<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\StokMasuk;
use App\Models\StokKeluar; 
use App\Models\Pupuk; 
use App\Models\ManajemenPembelian; 
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // Helper untuk ambil data user dan view sesuai role & halaman
    private function loadViewByRole(string $page, array $extraData = [])
    {
        $user = Auth::user();
        $role = $user->role;
        $data = array_merge($extraData, ['getRecord' => User::find($user->id_user)]);

        $viewPath = "$role.$page";

        if (view()->exists($viewPath)) {
            return view($viewPath, $data);
        }
        
        abort(403, 'Unauthorized or view not found.');
    }

    public function stokPupuk(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'nama_pupuk'); // Default sort by nama_pupuk
    
    $query = Pupuk::withSum('stokMasuks as total_masuk', 'jumlah_masuk')
                  ->withSum('stokKeluars as total_keluar', 'jumlah_keluar');
    
    if ($search) {
        $query->where('nama_pupuk', 'like', '%' . $search . '%');
    }
    
    // Apply sorting based on the sort_by parameter
    switch ($sortBy) {
        case 'total_masuk':
            $query->orderByRaw('COALESCE((SELECT SUM(jumlah_masuk) FROM stok_masuks WHERE stok_masuks.id_pupuk = pupuks.id_pupuk), 0) DESC');
            break;
        case 'total_keluar':
            $query->orderByRaw('COALESCE((SELECT SUM(jumlah_keluar) FROM stok_keluars WHERE stok_keluars.id_pupuk = pupuks.id_pupuk), 0) DESC');
            break;
        case 'sisa_stok':
            $query->orderByRaw('(COALESCE((SELECT SUM(jumlah_masuk) FROM stok_masuks WHERE stok_masuks.id_pupuk = pupuks.id_pupuk), 0) - COALESCE((SELECT SUM(jumlah_keluar) FROM stok_keluars WHERE stok_keluars.id_pupuk = pupuks.id_pupuk), 0)) DESC');
            break;
        case 'nama_pupuk':
        default:
            $query->orderBy('nama_pupuk', 'ASC');
            break;
    }
    
    // Using paginate(10) to divide data into pages
    $daftarPupuk = $query->paginate(10)->withQueryString();
    
    $daftarPupuk->each(function ($pupuk) {
        $pupuk->total_masuk = $pupuk->total_masuk ?? 0;
        $pupuk->total_keluar = $pupuk->total_keluar ?? 0;
        // Calculate remaining stock directly here
        $pupuk->sisa_stok = ($pupuk->total_masuk) - ($pupuk->total_keluar);
    });
    
    return view('read.stok_pupuk', compact('daftarPupuk'));
}

    /**
     * DIPERBARUI: Fungsi ini sekarang menangani logiknya sendiri
     * untuk memungkinkan fungsionalitas pencarian.
     */
    public function stokMasuk(Request $request)
    {
        $sortBy = $request->get('sort_by', 'tanggal_masuk');
        $sortDirection = $request->get('sort_direction', 'desc');
        $allowedSorts = ['tanggal_masuk', 'nama_pupuk', 'jumlah_masuk'];
        if (!in_array($sortBy, $allowedSorts)) $sortBy = 'tanggal_masuk';

        $query = StokMasuk::with(['user', 'pupuk']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('pupuk', fn($subQ) => $subQ->where('nama_pupuk', 'like', "%{$searchTerm}%"))
                  ->orWhereHas('user', fn($subQ) => $subQ->where('nama_user', 'like', "%{$searchTerm}%"));
            });
        }
        if ($request->filled('tanggal_dari')) $query->whereDate('tanggal_masuk', '>=', $request->tanggal_dari);
        if ($request->filled('tanggal_sampai')) $query->whereDate('tanggal_masuk', '<=', $request->tanggal_sampai);

        if ($sortBy === 'nama_pupuk') {
            $query->join('pupuks', 'stok_masuks.id_pupuk', '=', 'pupuks.id_pupuk')
                  ->orderBy('pupuks.nama_pupuk', $sortDirection)->select('stok_masuks.*');
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }
        
        $stokMasukHistory = $query->paginate(10)->withQueryString();
        return view('read.stok_masuk', compact('stokMasukHistory', 'sortBy', 'sortDirection'));
    }

    /**
     * DIPERBARUI: Menampilkan Riwayat Stok Keluar dengan filter, sorting, dan pagination.
     */
    public function stokKeluar(Request $request)
    {
        $sortBy = $request->get('sort_by', 'tanggal_keluar');
        $sortDirection = $request->get('sort_direction', 'desc');
        $allowedSorts = ['tanggal_keluar', 'nama_pupuk', 'jumlah_keluar'];
        if (!in_array($sortBy, $allowedSorts)) $sortBy = 'tanggal_keluar';

        $query = StokKeluar::with(['user', 'pupuk']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('pupuk', fn($subQ) => $subQ->where('nama_pupuk', 'like', "%{$searchTerm}%"))
                  ->orWhereHas('user', fn($subQ) => $subQ->where('nama_user', 'like', "%{$searchTerm}%"));
            });
        }
        if ($request->filled('tanggal_dari')) $query->whereDate('tanggal_keluar', '>=', $request->tanggal_dari);
        if ($request->filled('tanggal_sampai')) $query->whereDate('tanggal_keluar', '<=', $request->tanggal_sampai);

        if ($sortBy === 'nama_pupuk') {
            $query->join('pupuks', 'stok_keluars.id_pupuk', '=', 'pupuks.id_pupuk')
                  ->orderBy('pupuks.nama_pupuk', $sortDirection)->select('stok_keluars.*');
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }

        $stokKeluarHistory = $query->paginate(10)->withQueryString();
        return view('read.stok_keluar', compact('stokKeluarHistory', 'sortBy', 'sortDirection'));
    }

    public function laporanStok()
    {
        return $this->loadViewByRole('laporan_stok');
    }

    public function profileSettings()
    {
        return $this->loadViewByRole('profile_settings');
    }

    /**
     * FIXED: Fungsi manajemenPembelian yang sudah diperbaiki
     * Sekarang menangani filter dan pagination dengan benar
     */
    public function manajemenPembelian(Request $request)
    {
        $user = Auth::user();
        $query = ManajemenPembelian::with(['user', 'pemasok']);

        // --- Logika Filter ---
        // Pencarian umum
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pupuk', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('pemasok', function($subQ) use ($searchTerm) {
                      $subQ->where('nama_pemasok', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter untuk status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter spesifik tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_pembelian', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_pembelian', '<=', $request->tanggal_sampai);
        }

        // --- Logika berdasarkan role ---
        if ($user->hasRole('owner')) {
            // Owner bisa melihat semua data
            $pembelians = $query->orderBy('tanggal_pembelian', 'desc')->paginate(10);
        } 
        elseif ($user->hasRole('kepala_gudang')) {
            // Kepala gudang hanya melihat data yang sudah divalidasi
            $query->whereIn('status', ['validated', 'selesai']);
            $pembelians = $query->orderBy('tanggal_pembelian', 'desc')->paginate(10);
        }
        elseif ($user->hasRole('manager')) {
            // Manager bisa melihat semua data (read-only)
            $pembelians = $query->orderBy('tanggal_pembelian', 'desc')->paginate(10);
        }
        else {
            // Role lain default
            $pembelians = $query->orderBy('tanggal_pembelian', 'desc')->paginate(10);
        }

        // Kirim data ke view
        return view('read.manajemen_pembelian', compact('pembelians'));
    }

    public function validasiTransaksi(Request $request)
    {
        // Ambil parameter sorting dari URL, defaultnya tanggal terbaru
        $sortBy = $request->get('sort_by', 'tanggal_validasi');
        $sortDirection = $request->get('sort_direction', 'desc');

        // Daftar kolom yang aman untuk di-sort
        $allowedSorts = ['tanggal_validasi', 'status_validasi'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'tanggal_validasi';
        }

        // Memulai query dasar dengan memuat relasi yang diperlukan
        $query = ValidasiTransaksi::with(['user', 'pembelian.pemasok', 'pengajuanStokKeluar.pupuk']);

        // Terapkan sorting
        $query->orderBy($sortBy, $sortDirection);

        // Ambil hasil dengan pagination (10 data per halaman)
        $validations = $query->paginate(10)->withQueryString();

        // Mengirim data ke view read-only
        return view('owner.validasi_transaksi', compact('validations', 'sortBy', 'sortDirection'));
    }

    public function kelolaUser()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'owner') {
            $query = User::where('role', '!=', 'owner');

            if ($search = request('search')) {
                $query->where(function($q) use ($search) {
                    $q->where('id_user', 'like', "%$search%")
                      ->orWhere('nama_user', 'like', "%$search%");
                });
            }

            $users = $query->get();
            return view('owner.kelola_user', [
                'getRecord' => User::find($user->id_user),
                'users' => $users,
            ]);
        }

        // Untuk role lain hanya tampilkan view tanpa daftar user
        $viewPath = "$role.kelola_user";
        if (view()->exists($viewPath)) {
            return view($viewPath, ['getRecord' => User::find($user->id_user)]);
        }

        abort(403, 'Unauthorized or view not found.');
    }
}