@extends('layouts.kepala_gudang')

@section('title', 'Riwayat Stok Keluar')

@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
    .table th { background-color: #4A5568; color: #FFFFFF; }
    .btn { display: inline-block; padding: 8px 12px; font-size: 14px; text-align: center; cursor: pointer; border-radius: 4px; text-decoration: none; }
    .btn i { margin-right: 5px; }
    .btn-primary { color: #fff; background-color: #007bff; }
</style>

<div class="container">
    <div class="page-header">
        <h2>Riwayat Stok Keluar</h2>
        <a href="{{ route('kepala_gudang.stok_keluar.create') }}" class="btn btn-primary">
            <i class="fas fa-minus"></i> Catat Stok Keluar
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah Keluar</th>
                <th>Tanggal Keluar</th>
                {{-- DIUBAH: Header kolom disesuaikan --}}
                <th>Lokasi</th>
                <th>Dicatat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stokKeluarHistory as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pupuk->nama_pupuk ?? 'N/A' }}</td>
                    <td><strong>{{ $item->jumlah_keluar }} {{ $item->pupuk->satuan ?? '' }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->isoFormat('D MMMM Y') }}</td>
                    {{-- DIUBAH: Menampilkan data dari kolom 'lokasi' --}}
                    <td>{{ $item->tujuan ?? '-' }}</td>
                    <td>{{ $item->user->nama_user ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">Belum ada riwayat stok keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
