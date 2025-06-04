<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // Helper untuk ambil data user dan view sesuai role & halaman
    private function loadViewByRole(string $page, array $extraData = [])
    {
        $user = Auth::user();
        $role = $user->role;
        $data = array_merge($extraData, ['getRecord' => User::find($user->id_user)]);
        
        // Jika halaman stok_masuk owner, tambahkan data stok masuk
        if ($page === 'stok_masuk' && $role === 'owner') {
            $data['stokMasuk'] = \App\Models\StokMasuk::with(['pupuk', 'user'])->latest()->get();
        }

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

    public function stokMasuk()
    {
        return $this->loadViewByRole('stok_masuk');
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
        return $this->loadViewByRole('manajemen_pembelian');
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

    public function pemasok()
    {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'kepala_admin') {
            $query = User::where('role', '!=', 'kepala_admin');

            if ($search = request('search')) {
                $query->where(function($q) use ($search) {
                    $q->where('id_pemasok', 'like', "%$search%")
                    ->orWhere('nama_pemasok', 'like', "%$search%");
                });
            }

            $users = $query->get();
            return view('kepala_admin.pemasok', [
                'getRecord' => User::find($user->id_user),
                'users' => $users,
            ]);
        }

        // Untuk role lain hanya tampilkan view tanpa daftar user
        $viewPath = "$role.pemasok";
        if (view()->exists($viewPath)) {
            return view($viewPath, ['getRecord' => User::find($user->id_user)]);
        }

        abort(403, 'Unauthorized or view not found.');
    }
}
