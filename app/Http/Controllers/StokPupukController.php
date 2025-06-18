<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
// Pastikan Anda juga mengimpor model User jika diperlukan untuk role check
use Illuminate\Support\Facades\Auth; 

class StokPupukController extends Controller
{
    public function stokPupuk(Request $request)
    {
        // Ambil parameter dari request
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'nama_pupuk'); // Default sort by nama_pupuk
        $sortOrder = $request->get('sort_order', 'asc'); // Default ascending
        // HAPUS: $perPage = $request->get('per_page', 10);

        // Validasi sort_by untuk keamanan
        $allowedSortFields = ['nama_pupuk', 'total_masuk', 'total_keluar', 'sisa_stok'];
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'nama_pupuk';
        }

        // Validasi sort_order
        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

        // Query builder dengan pencarian dan sorting
        $query = Stok::query();

        // Pencarian
        if ($search) {
            $query->where('nama_pupuk', 'LIKE', '%' . $search . '%');
        }

        // Sorting
        $query->orderBy($sortBy, $sortOrder);

        // Pagination - menggunakan nilai tetap (10)
        $daftarPupuk = $query->paginate(10);

        // Append query parameters untuk pagination links (tanpa per_page)
        $daftarPupuk->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        // Menggunakan view dari jawaban sebelumnya
        // Pastikan nama view-nya benar, contoh: 'stok_pupuk.index'
        $viewName = Auth::user()->role . '.stok_pupuk'; // Asumsi dari view Anda
        if (!view()->exists($viewName)) {
            // Fallback view jika view spesifik role tidak ada
            $viewName = 'stok_pupuk.index'; 
        }

        return view($viewName, compact('daftarPupuk'));
    }

    public function stokMasuk()
    {
        // Hanya Owner dan Kepala Gudang yang bisa menambah stok masuk
        // PERBAIKAN: Gunakan 'kepala_gudang' agar konsisten
        if (!in_array(auth()->user()->role, ['owner', 'kepala_gudang'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        // Logika untuk menambah stok masuk
        return view('stok_masuk.create');
    }

    public function stokKeluar()
    {
        // Hanya Owner dan Kepala Gudang yang bisa mengelola stok keluar
        if (!in_array(auth()->user()->role, ['owner', 'kepala_gudang'])) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        // Logika untuk mengelola stok keluar
        return view('stok_keluar.create');
    }

    public function laporanStok(Request $request)
    {
        // Semua peran bisa melihat laporan stok
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'nama_pupuk');
        $sortOrder = $request->get('sort_order', 'asc');
        // HAPUS: $perPage = $request->get('per_page', 10);

        // Validasi sort_by untuk keamanan
        $allowedSortFields = ['nama_pupuk', 'total_masuk', 'total_keluar', 'sisa_stok'];
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'nama_pupuk';
        }

        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

        $query = Stok::query();

        if ($search) {
            $query->where('nama_pupuk', 'LIKE', '%' . $search . '%');
        }

        $query->orderBy($sortBy, $sortOrder);
        
        // Menggunakan pagination tetap
        $laporan = $query->paginate(10);

        // Append query tanpa per_page
        $laporan->appends([
            'search' => $search,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        return view('laporan_stok.index', compact('laporan'));
    }
}