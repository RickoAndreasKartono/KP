{{-- Layout akan menyesuaikan secara dinamis dengan peran yang sedang login --}}
@extends('layouts.' . Auth::user()->role)

@section('title', 'Riwayat Stok Keluar')

@section('content')
<style>
    /* Styling dasar untuk halaman, bisa dipindahkan ke file CSS utama */
    .container { padding: 20px; }
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
    .table th { background-color: #4A5568; color: #FFFFFF; font-weight: 600; }
</style>

<div class="container">
    <h2>Riwayat Stok Keluar</h2>
    <p>Halaman ini menampilkan seluruh catatan barang yang telah keluar dari gudang.</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah Keluar</th>
                <th>Tujuan</th>
                <th>Tanggal Keluar</th>
                <th>Dicatat oleh (Gudang)</th>
            </tr>
        </thead>
        <tbody>
            {{-- Variabel $stokKeluarHistory dikirim dari StokKeluarController --}}
            @forelse ($stokKeluarHistory as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pupuk->nama_pupuk ?? 'Data Pupuk Dihapus' }}</td>
                    <td><strong>{{ $item->jumlah_keluar }} {{ $item->pupuk->satuan ?? '' }}</strong></td>
                    <td>{{ $item->tujuan ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->isoFormat('D MMMM Y, HH:mm') }}</td>
                    <td>{{ $item->user->nama_user ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        Belum ada riwayat stok keluar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
