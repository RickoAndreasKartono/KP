<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMasuk;
use PDF;

class LaporanStokController extends Controller
{
    
    public function index(Request $request)
    {
        $tahun = $request->get('tahun');
        $stokMasuk = [];
        

        if ($tahun) {
           $stokMasuk = StokMasuk::with(['pupuk', 'pemasok'])
                      ->whereYear('tanggal_masuk', $tahun)
                      ->get();
        }

        $semuaTahun = StokMasuk::selectRaw('YEAR(tanggal_masuk) as tahun')->distinct()->pluck('tahun');

        $role = auth()->user()->role; // bisa 'owner', 'manager', dst

        return view('laporan_stok.laporan', compact('stokMasuk', 'tahun', 'semuaTahun', 'role'));

    }

    public function exportPdf(Request $request)
    {
        $tahun = $request->get('tahun');
        $stokMasuk = StokMasuk::with(['pupuk', 'pemasok'])
                    ->whereYear('tanggal_masuk', $tahun)
                    ->get();

        $pdf = PDF::loadView('laporan_stok.stok_pdf', compact('stokMasuk', 'tahun'))
                ->setPaper('a4', 'landscape');

        return $pdf->download("Laporan_Stok_Tahun_$tahun.pdf");
    }

}
