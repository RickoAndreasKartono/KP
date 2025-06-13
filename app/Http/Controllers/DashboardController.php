<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\StokMasuk; // DITAMBAHKAN: Import model StokMasuk
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

    public function stokPupuk()
    {
        return $this->loadViewByRole('stok_pupuk');
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

    public function stokKeluar()
    {
        return $this->loadViewByRole('stok_keluar');
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
        return $this->loadViewByRole('validasi_transaksi');    
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
