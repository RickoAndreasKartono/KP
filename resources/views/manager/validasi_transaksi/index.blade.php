{{-- File: resources/views/manager/validasi_transaksi/index.blade.php --}}

@extends('layouts.manager') {{-- Pastikan layout ini ada dan sesuai --}}

@section('title', 'Daftar Validasi')

@section('section-header')
<div class="section-header">
    <h1>Daftar Validasi</h1>
</div>
@endsection

@section('content')
<style>
    .card-body {
        padding: 25px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .status {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        text-transform: capitalize;
    }
    .status.pending { background-color: #ffc107; color: #333; }
    .status.validated { background-color: #28a745; }
    .status.rejected { background-color: #dc3545; }

    .action-btn {
        background-color: transparent;
        border: none;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        color: white;
        margin: 0 2px;
        transition: background-color 0.2s;
    }
    .btn-approve { background-color: #28a745; }
    .btn-approve:hover { background-color: #218838; }
    .btn-reject { background-color: #dc3545; }
    .btn-reject:hover { background-color: #c82333; }
</style>

<div class="card">
    <div class="card-header">
        <h4>Data Pengajuan Validasi</h4>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
           {{-- Ganti seluruh blok table lama Anda dengan yang baru ini --}}
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            {{-- DIPERBARUI: Kolom diubah menjadi lebih spesifik --}}
            <th>Nama Pupuk</th>
            <th>Jumlah</th>
            <th>Diajukan Oleh</th>
            <th>Tanggal Pengajuan</th>
            <th>Status</th>
            <th style="width: 150px; text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($validations as $validasi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                
                {{-- DIPERBARUI: Menampilkan Nama Pupuk dari relasi --}}
                <td>
                    @if ($pembelian = $validasi->pembelian)
                        {{ $pembelian->nama_pupuk ?? 'N/A' }}
                    @elseif ($stokKeluar = $validasi->stokKeluar)
                        {{-- Asumsi: Model StokKeluar memiliki properti/relasi nama_pupuk --}}
                        {{ $stokKeluar->nama_pupuk ?? 'N/A' }}
                    @else
                        -
                    @endif
                </td>

                {{-- DIPERBARUI: Menampilkan Jumlah dan Satuan dari relasi --}}
                <td>
                    @if ($pembelian = $validasi->pembelian)
                        {{ $pembelian->jumlah }} {{ $pembelian->satuan }}
                    @elseif ($stokKeluar = $validasi->stokKeluar)
                        {{ $stokKeluar->jumlah }} {{ $stokKeluar->satuan }}
                    @else
                        -
                    @endif
                </td>

                <td>{{ $validasi->user->nama_user ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($validasi->created_at)->isoFormat('D MMMM Y') }}</td>
                <td>
                    <span class="status {{ strtolower($validasi->status_validasi) }}">
                        {{ ucfirst($validasi->status_validasi) }}
                    </span>
                </td>
                <td style="text-align: center;">
                    @if ($validasi->status_validasi == 'pending')
                        {{-- Form untuk Approve --}}
                        <form action="{{ route('manager.validasi_transaksi.approve', $validasi->id_validasi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Anda yakin ingin MEMVALIDASI pengajuan ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn btn-approve" title="Validasi Pengajuan">Validasi</button>
                        </form>
                        
                        {{-- Form untuk Reject --}}
                        <form action="{{ route('manager.validasi_transaksi.reject', $validasi->id_validasi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Anda yakin ingin MENOLAK pengajuan ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn btn-reject" title="Tolak Pengajuan">Tolak</button>
                        </form>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                {{-- Colspan disesuaikan dengan jumlah kolom baru (7) --}}
                <td colspan="7" class="text-center py-5">Tidak ada data pengajuan validasi.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
