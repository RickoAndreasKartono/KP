<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ManajemenPembelian;
use App\Models\StokMasuk;
use App\Models\StokKeluar; 
use App\Models\Pupuk; 
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // Helper untuk ambil data user dan view sesuai role & halaman
    private function loadViewByRole(string $page, array $extraData = [])
    {
        $user = Auth::user();
        $role = $user->role;
        $data = array_merge($extraData, ['getRecord' => User::find($user->id_user)]);
        
        // DIHAPUS: Logika stok masuk dipindahkan ke fungsinya sendiri
        // if ($page === 'stok_masuk' && $role === 'owner') { ... }

        $viewPath = "$role.$page";

        if (view()->exists($viewPath)) {
            return view($viewPath, $data);
        }
        
        abort(403, 'Unauthorized or view not found.');
    }

     public function stokPupuk(Request $request)
    {
        // Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // Mulai query untuk mengambil data master pupuk
        // dengan menghitung total dari relasi stokMasuks dan stokKeluars
        $query = Pupuk::withSum('stokMasuks as total_masuk', 'jumlah_masuk')
                      ->withSum('stokKeluars as total_keluar', 'jumlah_keluar')
                      ->orderBy('nama_pupuk');

        // Filter data jika ada pencarian
        if ($search) {
            $query->where('nama_pupuk', 'like', '%' . $search . '%');
        }

        $daftarPupuk = $query->get();
        
        // Hitung sisa stok untuk setiap item pupuk
        $daftarPupuk->each(function ($pupuk) {
            $pupuk->total_masuk = $pupuk->total_masuk ?? 0;
            $pupuk->total_keluar = $pupuk->total_keluar ?? 0;
            $pupuk->sisa_stok = $pupuk->total_masuk - $pupuk->total_keluar;
        });

        // Kirim data yang sudah dihitung ke view
        return view('read.stok_pupuk', compact('daftarPupuk'));
    }


    /**
     * DIPERBARUI: Fungsi ini sekarang menangani logikanya sendiri
     * untuk memungkinkan fungsionalitas pencarian.
     */
    public function stokMasuk(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Mulai query untuk mengambil data stok masuk
        $query = StokMasuk::with(['user', 'pupuk'])->latest('tanggal_masuk');

        // 3. Jika ada kata kunci pencarian, filter data
        if ($search) {
            $query->whereHas('pupuk', function ($q) use ($search) {
                $q->where('nama_pupuk', 'like', '%' . $search . '%');
            });
        }

        // 4. Ambil hasil akhir dari query
        $stokMasuk = $query->get();

        // 5. Kirim data yang sudah disaring ke view milik owner
        // (Asumsi view ada di 'owner.stok_masuk.index' atau 'owner.stok_masuk')
        return view('read.stok_masuk', compact('stokMasuk'));
    
    }

    public function stokKeluar(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Mulai query untuk mengambil data stok keluar
        $query = StokKeluar::with(['user', 'pupuk'])->latest('tanggal_keluar');

        // 3. Jika ada kata kunci pencarian, filter data
        if ($search) {
            $query->whereHas('pupuk', function ($q) use ($search) {
                $q->where('nama_pupuk', 'like', '%' . $search . '%');
            });
        }

        // 4. Ambil hasil akhir dari query
        $stokKeluarHistory = $query->get();

        // 5. Tentukan path view berdasarkan role
        $viewPath = 'read.stok_keluar'; // Menggunakan view bersama

        // Anda bisa menambahkan logika untuk path view yang berbeda per role jika perlu
        // if(view()->exists(Auth::user()->role . '.stok_keluar')) {
        //     $viewPath = Auth::user()->role . '.stok_keluar';
        // }

        return view($viewPath, ['stokKeluarHistory' => $stokKeluarHistory]);
    }

    public function laporanStok()
    {
        return $this->loadViewByRole('laporan_stok');
    }

    public function profileSettings()
    {
        return $this->loadViewByRole('profile_settings');
    }

    public function manajemenPembelian()
    {
        // Logika di sini, misalnya:
        $pembelians = ManajemenPembelian::with('pemasok', 'user')->get();

        return view('manager.manajemen_pembelian', compact('pembelians'));
    }


    public function validasiTransaksi()
    {
        return $this->loadViewByRole('validasi_transaksi');
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
