<?php

// File: app/Http/Controllers/ValidasiTransaksiController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\ManajemenPembelian;
use App\Models\ValidasiTransaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ValidasiTransaksiController extends Controller
{
    /**
     * Menampilkan daftar validasi dengan filter dan pagination.
     */
    public function index(Request $request)
    {

    $sortBy = $request->get('sort_by', 'created_at');
    $sortDirection = $request->get('sort_direction', 'desc');
    
        $query = ValidasiTransaksi::whereNotNull('id_pembelian')
                                ->with(['pembelian.pemasok', 'user']);

        // --- SECTION FILTER ---
        $filtersApplied = []; // Array untuk menyimpan filter yang diterapkan

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
            $filtersApplied[] = 'Tanggal Dari: ' . Carbon::parse($request->tanggal_dari)->isoFormat('D MMMM Y');
        }
        
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
            $filtersApplied[] = 'Tanggal Sampai: ' . Carbon::parse($request->tanggal_sampai)->isoFormat('D MMMM Y');
        }

        if ($request->filled('nama_pupuk')) {
            $nama_pupuk = $request->nama_pupuk;
            $query->whereHas('pembelian', function($subq) use ($nama_pupuk) {
                $subq->where('nama_pupuk', 'like', '%' . $nama_pupuk . '%');
            });
            $filtersApplied[] = 'Pupuk: "' . $nama_pupuk . '"';
        }

        if ($request->filled('diajukan_oleh')) {
            $nama_user = $request->diajukan_oleh;
            $query->whereHas('user', function($q) use ($nama_user) {
                $q->where('nama_user', 'like', '%' . $nama_user . '%');
            });
            $filtersApplied[] = 'Diajukan Oleh: "' . $nama_user . '"';
        }
        
        if ($request->filled('status_validasi')) {
            $status_filter = $request->status_validasi;
            $displayStatus = '';
            if ($status_filter === 'disetujui') {
                $status_filter = 'validated';
                $displayStatus = 'Disetujui';
            } elseif ($status_filter === 'ditolak') {
                $status_filter = 'rejected';
                $displayStatus = 'Ditolak';
            } else {
                $displayStatus = 'Pending';
            }
            $query->where('status_validasi', $status_filter);
            $filtersApplied[] = 'Status: "' . $displayStatus . '"';
        }

      
        $validations = $query->latest('created_at')
                             ->orderByRaw("FIELD(status_validasi, 'pending', 'validated', 'rejected')")
                             ->paginate(10)
                             ->withQueryString();

        // Perbaikan 2: Pastikan total data benar dengan menghitung ulang jika perlu
        $totalCount = $validations->total();
        
        // Siapkan pesan notifikasi
        $notificationMessage = '';
        if (!empty($filtersApplied)) {
            $notificationMessage = 'Menampilkan hasil filter : ' . implode(' - ', $filtersApplied) . ' Dengan Total: ' . $totalCount . ' data';
        } else {
            $notificationMessage = 'Total data: ' . $totalCount . ' pembelian';
        }

        if (Auth::user()->role === 'owner') {
            // Jika OWNER yang login, kirim ke view owner
            return view('owner.validasi_transaksi', compact('validations', 'sortBy', 'sortDirection', 'notificationMessage'));
        } else {
            // Jika MANAGER (atau role lain) yang login, kirim ke view manager
            // PASTIKAN NAMA VIEW INI BENAR: 'manager.validasi_transaksi.index'
            return view('manager.validasi_transaksi.index', compact('validations', 'sortBy', 'sortDirection', 'notificationMessage'));
        }
    }

    /**
     * Menyetujui pengajuan validasi dan memberi umpan balik.
     */
    public function approve($id_validasi)
    {
        $validasi = ValidasiTransaksi::findOrFail($id_validasi);
        
        if ($validasi->status_validasi !== 'pending') {
            return redirect()->route('manager.validasi_transaksi.index')
                           ->with('error', 'Tindakan tidak dapat dilakukan karena status telah diubah.');
        }

        // Perbaikan 3: Gunakan DB transaction untuk konsistensi data
        \DB::transaction(function () use ($validasi) {
            $validasi->status_validasi = 'validated';
            $validasi->save();

            if ($validasi->id_pembelian) {
                $pembelian = ManajemenPembelian::find($validasi->id_pembelian);
                if ($pembelian) {
                    $pembelian->status = 'validated';
                    $pembelian->save();
                }
            }
        });
        
        return redirect()->route('manager.validasi_transaksi.index')
                       ->with('success', 'Pengajuan berhasil divalidasi.');
    }

    /**
     * Menolak pengajuan validasi dan memberi umpan balik.
     */
    public function reject($id_validasi)
    {
        $validasi = ValidasiTransaksi::findOrFail($id_validasi);

        if ($validasi->status_validasi !== 'pending') {
            return redirect()->route('manager.validasi_transaksi.index')
                           ->with('error', 'Tindakan tidak dapat dilakukan karena status telah diubah.');
        }

        // Perbaikan 4: Gunakan DB transaction untuk konsistensi data
        \DB::transaction(function () use ($validasi) {
            $validasi->status_validasi = 'rejected';
            $validasi->save();

            if ($validasi->id_pembelian) {
                $pembelian = ManajemenPembelian::find($validasi->id_pembelian);
                if ($pembelian) {
                    $pembelian->status = 'rejected';
                    $pembelian->save();
                }
            }
        });

        return redirect()->route('manager.validasi_transaksi.index')
                       ->with('success', 'Pengajuan telah ditolak.');
    }
}