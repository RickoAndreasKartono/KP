<?php

namespace App\Http\Controllers; // Sesuaikan namespace jika controller Anda ada di folder lain

use App\Http\Controllers\Controller;
use App\Models\Pupuk;
use App\Models\StokMasuk;
use App\Models\ManajemenPembelian;
use App\Models\ValidasiTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StokMasukController extends Controller
{
    /**
     * Fungsi ini akan menampilkan halaman yang berbeda berdasarkan role pengguna.
     */
       public function index(Request $request) // Tambahkan Request untuk sorting
    {
        $userRole = Auth::user()->role;

        if ($userRole == 'kepala_gudang') {
            // UNTUK KEPALA GUDANG: Tampilkan daftar master pupuk untuk dikelola (CRUD)

            // DITAMBAHKAN: Logika untuk sorting dan pagination untuk Kepala Gudang
            $sortBy = $request->get('sort_by', 'nama_pupuk');
            $sortDirection = $request->get('sort_direction', 'asc');
            $allowedSorts = ['nama_pupuk', 'jumlah_tersedia'];

            if (!in_array($sortBy, $allowedSorts)) {
                $sortBy = 'nama_pupuk';
            }

            $daftarPupuk = Pupuk::orderBy($sortBy, $sortDirection)->paginate(10);
            
            // DIPERBARUI: Kirim variabel sorting ke view
            return view('kepala_gudang.stok_masuk.index', compact('daftarPupuk', 'sortBy', 'sortDirection'));
        
        } elseif (in_array($userRole, ['owner', 'manager', 'kepala_admin'])) {
            // UNTUK ROLE LAIN: Tampilkan riwayat stok masuk dengan sorting dan pagination

            // Ambil parameter sorting dari URL
            $sortBy = $request->get('sort_by', 'tanggal_masuk');
            $sortDirection = $request->get('sort_direction', 'desc');
            $allowedSorts = ['tanggal_masuk', 'nama_pupuk', 'jumlah_masuk'];

            if (!in_array($sortBy, $allowedSorts)) {
                $sortBy = 'tanggal_masuk';
            }

            $query = StokMasuk::with(['user', 'pupuk']);

            // Terapkan sorting
            if ($sortBy === 'nama_pupuk') {
                $query->join('pupuks', 'stok_masuks.id_pupuk', '=', 'pupuks.id_pupuk')
                      ->orderBy('pupuks.nama_pupuk', $sortDirection)
                      ->select('stok_masuks.*');
            } else {
                $query->orderBy($sortBy, $sortDirection);
            }

            $stokMasukHistory = $query->paginate(10)->withQueryString();
            
            // Arahkan ke view bersama (shared) untuk riwayat
            return view('read.stok_masuk', compact('stokMasukHistory', 'sortBy', 'sortDirection'));
        
        } else {
            // Fallback jika ada role lain yang tidak terdefinisi
            abort(403, 'Akses Ditolak.');
        }
    }


    /**
     * Menampilkan form untuk membuat data master pupuk baru.
     */
    public function create()
    {
        // Mengambil data pembelian yang statusnya 'validated' 
        $pembelianDisetujui = ManajemenPembelian::with(['pemasok'])
            ->where('status', 'validated')
            ->get();

        // Menambahkan informasi apakah pembelian baru divalidasi (dalam 24 jam terakhir)
        $pembelianDisetujui = $pembelianDisetujui->map(function ($pembelian) {
            // Cek apakah pembelian ini baru diupdate dalam 24 jam terakhir (asumsi baru divalidasi)
            $pembelian->is_new_validation = $pembelian->updated_at >= Carbon::now()->subHours(24);
            return $pembelian;
        });

        // Urutkan: yang baru divalidasi di bawah, sisanya berdasarkan nama pupuk ascending
        $pembelianDisetujui = $pembelianDisetujui->sortBy([
            // Prioritas pertama: yang baru divalidasi (yang baru di bawah)
            function ($pembelian) {
                return $pembelian->is_new_validation ? 1 : 0; // 1 untuk yang baru (turun ke bawah)
            },
            // Prioritas kedua: nama pupuk ascending
            function ($pembelian) {
                return $pembelian->nama_pupuk;
            }
        ]);
        
        // Mengirim data ke view 'create.blade.php'
        return view('kepala_gudang.stok_masuk.create', compact('pembelianDisetujui'));
    }

    /**
     * Menyimpan data stok masuk dari pemrosesan pembelian.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'id_pembelian' => 'required|exists:manajemen_pembelians,id_pembelian',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        $pembelian = ManajemenPembelian::findOrFail($validatedData['id_pembelian']);

        // Validasi tambahan untuk mencegah pemrosesan ganda
        if ($pembelian->status !== 'validated') {
            return redirect()->back()->with('error', 'Pembelian ini sudah diproses atau statusnya tidak valid.')->withInput();
        }

        // Cari master pupuk. Jika tidak ada, buat baru.
        $pupuk = Pupuk::firstOrCreate(
            ['nama_pupuk' => $pembelian->nama_pupuk],
            ['satuan' => $pembelian->satuan, 'jumlah_tersedia' => 0]
        );

        // 1. Catat transaksi di riwayat stok_masuks
        StokMasuk::create([
            'id_pupuk' => $pupuk->id_pupuk,
            'id_pembelian' => $pembelian->id_pembelian,
            'jumlah_masuk' => $validatedData['jumlah_masuk'],
            'tanggal_masuk' => $validatedData['tanggal_masuk'],
            'id_user' => Auth::id(),
            'pemasok' => $pembelian->pemasok->nama_pemasok ?? 'N/A',
        ]);

        // 2. Tambahkan jumlah stok di tabel master pupuks
        $pupuk->increment('jumlah_tersedia', $validatedData['jumlah_masuk']);

      

        // Redirect ke halaman daftar master stok dengan pesan sukses
        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Stok dari pembelian berhasil diproses dan ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk data master pupuk.
     */
    public function edit(Pupuk $pupuk)
    {
        return view('kepala_gudang.stok_masuk.edit', compact('pupuk'));
    }

    /**
     * Menyimpan perubahan data master pupuk.
     */
    public function update(Request $request, Pupuk $pupuk)
    {
        $validatedData = $request->validate([
            'nama_pupuk' => 'required|string|max:255|unique:pupuks,nama_pupuk,' . $pupuk->id_pupuk . ',id_pupuk',
            'satuan' => 'required|string|max:50',
            'jumlah_tersedia' => 'required|integer|min:0',
        ]);
        
        $pupuk->update($validatedData);
        
        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Data master pupuk berhasil diperbarui.');
    }

    /**
     * Menghapus data master pupuk.
     */
    public function destroy(Pupuk $pupuk)
    {
        $pupuk->delete();
        return redirect()->route('kepala_gudang.stok_masuk.index')->with('success', 'Data pupuk berhasil dihapus.');
    }
}