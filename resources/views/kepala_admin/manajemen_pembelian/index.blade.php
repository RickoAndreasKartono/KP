@extends('layouts.kepala_admin') {{-- Pastikan nama file layout ini sesuai dengan proyek Anda --}}

@section('title', 'Manajemen Pembelian')

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
    }
    .table th {
        /* DIPERBARUI: Mengubah warna latar belakang header tabel agar lebih gelap dan teks menjadi putih */
        background-color: #4A5568; /* Abu-abu gelap untuk kontras */
        color: #FFFFFF; /* Teks putih agar mudah dibaca */
        font-weight: 600;
    }
    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .table tr:hover {
        background-color: #e9ecef;
    }
    .btn {
        display: inline-block;
        padding: 8px 16px;
        margin: 2px;
        font-size: 14px;
        font-weight: 400;
        text-align: center;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-warning {
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>

<div class="container">
    <h2>Daftar Pengajuan Pembelian</h2>

    {{-- Tombol untuk mengarahkan ke halaman tambah data --}}
    <a href="{{ route('kepala_admin.manajemen_pembelian.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">
        + Buat Pengajuan Baru
    </a>

    {{-- Notifikasi untuk pesan sukses atau error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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
                        {{-- Mengubah tampilan status agar lebih menarik --}}
                        <span style="font-weight: bold; color: {{ $pembelian->status == 'pending' ? '#ffc107' : ($pembelian->status == 'disetujui' ? '#28a745' : '#dc3545') }}">
                            {{ ucfirst($pembelian->status) }}
                        </span>
                    </td>
                    <td>{{ $pembelian->user->nama_user ?? 'N/A' }}</td>
                    <td>
                        {{-- Tombol Aksi hanya muncul jika status masih 'pending' --}}
                        @if ($pembelian->status == 'pending')
                            {{-- DIPERBAIKI: Parameter dibuat eksplisit --}}
                            <a href="{{ route('kepala_admin.manajemen_pembelian.edit', ['manajemenPembelian' => $pembelian->id_pembelian]) }}" class="btn btn-warning">Edit</a>
                            {{-- DIPERBAIKI: Parameter dibuat eksplisit --}}
                            <form action="{{ route('kepala_admin.manajemen_pembelian.destroy', ['manajemenPembelian' => $pembelian->id_pembelian]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @empty
                {{-- Pesan jika tidak ada data sama sekali --}}
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">Belum ada data pengajuan pembelian.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
