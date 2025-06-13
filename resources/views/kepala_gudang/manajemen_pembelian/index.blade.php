@extends('layouts.kepala_gudang') {{-- Menggunakan layout khusus Kepala Gudang --}}

@section('title', 'Daftar Pembelian Disetujui')

@section('content')
<style>
    /* Styling sederhana untuk mempercantik tampilan */
    .container {
        padding: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        vertical-align: middle;
    }
    .table th {
        background-color: #4A5568;
        color: #FFFFFF;
        font-weight: 600;
    }
    .status-badge {
        padding: .4em .7em; font-size: .8em; font-weight: 700;
        border-radius: .25rem;
        color: #fff;
        background-color: #28a745; /* Hanya akan ada status disetujui */
    }
</style>

<div class="container">
    <h2>Daftar Pembelian Disetujui</h2>
    <p>Di bawah ini adalah daftar pembelian yang sudah disetujui oleh Manager.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah</th>
                <th>Pemasok</th>
                <th>Tanggal Pembelian</th>
                <th>Status</th>
                <th>Diajukan Oleh</th>
                {{-- DIHAPUS: Kolom Aksi dihilangkan --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelians as $pembelian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembelian->nama_pupuk }}</td>
                    <td>{{ $pembelian->jumlah }} {{ $pembelian->satuan }}</td>
                    <td>{{ $pembelian->pemasok }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->isoFormat('D MMMM Y') }}</td>
                    <td>
                        <span class="status-badge">
                            {{ ucfirst($pembelian->status) }}
                        </span>
                    </td>
                    <td>{{ $pembelian->user->nama_user ?? 'N/A' }}</td>
                    {{-- DIHAPUS: Kolom Aksi dihilangkan --}}
                </tr>
            @empty
                {{-- Pesan jika tabel kosong --}}
                <tr>
                    {{-- Colspan disesuaikan menjadi 7 --}}
                    <td colspan="7" style="text-align: center; padding: 20px;">
                        Tidak ada data pembelian yang sudah disetujui.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
