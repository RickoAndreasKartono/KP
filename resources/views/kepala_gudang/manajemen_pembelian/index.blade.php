@extends('layouts.kepala_gudang') {{-- Menggunakan layout khusus Kepala Gudang --}}

@section('title', 'Proses Pembelian Masuk')

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
    .btn-proses {
        color: #fff;
        background-color: #17a2b8; /* Info Cyan */
        border-color: #17a2b8;
        font-weight: bold;
        display: inline-block; padding: 8px 16px; margin: 2px;
        font-size: 14px; text-align: center; cursor: pointer;
        border: 1px solid transparent; border-radius: 4px;
        text-decoration: none; transition: all 0.2s ease-in-out;
    }
    .alert {
        padding: 15px; margin-bottom: 20px; border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
    .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
    .status-badge {
        padding: .4em .7em; font-size: .8em; font-weight: 700;
        border-radius: .25rem;
        color: #fff;
        background-color: #28a745; /* Hanya akan ada status disetujui */
    }
</style>

<div class="container">
    <h2>Daftar Pembelian Siap Proses</h2>
    <p>Di bawah ini adalah daftar pembelian yang sudah disetujui dan siap untuk diproses menjadi stok masuk.</p>

    {{-- Notifikasi untuk pesan sukses atau error --}}
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
                <th>Aksi</th>
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
                    <td>
                        {{-- Aksi khusus untuk Kepala Gudang --}}
                        <form action="{{ route('kepala_gudang.manajemen_pembelian.proses', $pembelian->id_pembelian) }}" method="POST" onsubmit="return confirm('Proses pembelian ini menjadi stok masuk?');">
                            @csrf
                            <button type="submit" class="btn btn-proses">Proses Stok</button>
                        </form>
                    </td>
                </tr>
            @empty
                {{-- Pesan jika tabel kosong --}}
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">
                        Tidak ada data pembelian yang perlu diproses saat ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
