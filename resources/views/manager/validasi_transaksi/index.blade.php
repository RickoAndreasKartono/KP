{{-- File: resources/views/manager/validasi_transaksi/index.blade.php --}}

@extends('layouts.manager')

@section('title', 'Daftar Validasi Transaksi')

@section('content')
<style>
    /* Styling Dasar untuk Container dan Header */
    .container {
        padding: 20px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 400;
        color: #5a5c69;
        margin: 0;
    }

    /* Styling untuk Filter Card */
    .filter-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
        padding: 1.25rem;
        margin-bottom: 25px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: flex-end; /* Memastikan tombol filter sejajar dengan input */
    }

    .filter-group {
        flex: 1; /* Memungkinkan grup filter menyesuaikan lebar */
        min-width: 180px; /* Lebar minimum agar tidak terlalu sempit */
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #5a5c69;
        font-size: 14px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d1d3e2;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        align-items: flex-end; /* Memastikan tombol sejajar */
    }

    /* Styling untuk Tabel */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background: #fff;
        border-radius: 0.35rem; /* Sudut sedikit membulat untuk tabel */
        overflow: hidden; /* Penting agar border-radius berfungsi pada thead */
    }

    .table th,
    .table td {
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

    .table tr:nth-child(even) {
        background-color: #f8f9fc;
    }

    .table tr:hover {
        background-color: #eaecf4;
    }

    /* Styling untuk Tombol Umum */
    .btn {
        display: inline-block;
        padding: 8px 16px;
        margin: 2px; /* Disesuaikan agar tidak terlalu dekat satu sama lain */
        font-size: 14px;
        font-weight: 400;
        text-align: center;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s ease-in-out; /* Efek transisi saat hover */
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-primary {
        color: #fff;
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-reset {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-success {
        color: #fff;
        background-color: #1cc88a;
        border-color: #1cc88a;
    }

    .btn-danger {
        color: #fff;
        background-color: #e74a3b;
        border-color: #e74a3b;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }

    /* Styling untuk Notifikasi Alert (Success/Error) */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
    }

    .alert i {
        font-size: 18px;
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

    /* Styling untuk Notifikasi Bar (Total Data/Filter) */
    .notification-bar {
        background-color: #e0f2f7;
        border: 1px solid #b3e0ed;
        border-radius: 0.35rem;
        padding: 15px 20px;
        margin-bottom: 25px;
        color: #00566d;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .notification-bar i {
        color: #00566d;
        font-size: 18px;
    }

    /* Styling untuk Status Badge */
    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        text-transform: capitalize;
        display: inline-block; /* Agar padding dan border-radius terlihat baik */
    }

    .status-pending {
        background-color: #f6c23e;
        color: #333; /* Warna teks lebih gelap agar kontras */
    }

    .status-disetujui {
        background-color: #1cc88a;
    }

    .status-ditolak {
        background-color: #e74a3b;
    }

    /* Styling untuk Pagination */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Agar responsif pada layar kecil */
        gap: 10px;
    }

    .pagination-info {
        font-size: 15px;
        color: #5a5c69;
    }

    .pagination {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 5px;
    }

    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 12px;
        text-decoration: none;
        color: #5a5c69;
        background-color: #fff;
        border: 1px solid #d1d3e2;
        border-radius: 4px;
        transition: all 0.2s ease-in-out;
    }

    .pagination li a:hover {
        background-color: #f0f2f5;
    }

    .pagination li.active span {
        background-color: #4e73df;
        border-color: #4e73df;
        color: #fff;
    }
    .pagination li.disabled span {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    /* Utilitas */
    .text-center {
        text-align: center;
    }

    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .d-block {
        display: block;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="page-title">Daftar Validasi Transaksi</h2>
    </div>

    {{-- Filter Section --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('manager.validasi_transaksi.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="tanggal_dari">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" id="tanggal_dari" value="{{ request('tanggal_dari') }}">
                </div>
                <div class="filter-group">
                    <label for="tanggal_sampai">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" id="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                </div>
                <div class="filter-group">
                    <label for="nama_pupuk">Nama Pupuk</label>
                    <input type="text" name="nama_pupuk" id="nama_pupuk" value="{{ request('nama_pupuk') }}" placeholder="Cari pupuk...">
                </div>
                <div class="filter-group">
                    <label for="diajukan_oleh">Diajukan Oleh</label>
                    <input type="text" name="diajukan_oleh" id="diajukan_oleh" value="{{ request('diajukan_oleh') }}" placeholder="Cari pengaju...">
                </div>
                <div class="filter-group">
                    <label for="status_validasi">Status</label>
                    <select name="status_validasi" id="status_validasi">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status_validasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ request('status_validasi') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status_validasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('manager.validasi_transaksi.index') }}" class="btn btn-reset">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Notifikasi Umum (Success/Error Messages) --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Notifikasi Filter/Total Data - Ini yang Anda inginkan --}}
    <div class="notification-bar">
        <i class="fas fa-info-circle"></i> {{ $notificationMessage }}
    </div>

    {{-- Tabel Data --}}
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah</th>
                <th>Pemasok</th>
                <th>Diajukan Oleh</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($validations as $validasi)
                <tr>
                    <td>{{ ($validations->currentPage() - 1) * $validations->perPage() + $loop->iteration }}</td>
                    <td>
                        @if ($validasi->pembelian)
                            <strong>{{ $validasi->pembelian->nama_pupuk ?? 'N/A' }}</strong>
                        @else
                            <em>Data pembelian tidak ditemukan</em>
                        @endif
                    </td>
                    <td>
                        @if ($validasi->pembelian)
                            {{ number_format($validasi->pembelian->jumlah) }} {{ $validasi->pembelian->satuan }}
                        @else
                            <em>-</em>
                        @endif
                    </td>
                    <td>{{ $validasi->pembelian->pemasok->nama_pemasok ?? 'N/A' }}</td>
                    <td>{{ $validasi->user->nama_user ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($validasi->created_at)->isoFormat('D MMMM Y') }}</td>
                    <td>
                        @php
                            $statusClass = 'status-' . strtolower($validasi->status_validasi);
                            $statusText = '';
                            switch($validasi->status_validasi) {
                                case 'pending':
                                    $statusText = 'Pending';
                                    break;
                                case 'validated':
                                    $statusText = 'Disetujui';
                                    $statusClass = 'status-disetujui';
                                    break;
                                case 'rejected':
                                    $statusText = 'Ditolak';
                                    $statusClass = 'status-ditolak';
                                    break;
                                default:
                                    $statusText = ucfirst($validasi->status_validasi);
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        @if ($validasi->status_validasi == 'pending')
                            <div class="action-buttons">
                                <form action="{{ route('manager.validasi_transaksi.approve', $validasi->id_validasi) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyetujui pengajuan ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" title="Setujui Pengajuan">
                                        <i class="fas fa-check"></i> Setuju
                                    </button>
                                </form>

                                <form action="{{ route('manager.validasi_transaksi.reject', $validasi->id_validasi) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menolak pengajuan ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Tolak Pengajuan">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        @else
                            <span style="color: #858796;">Tidak ada aksi</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="fas fa-inbox fa-2x mb-2 d-block" style="color: #858796;"></i>
                        @if(request()->hasAny(['tanggal_dari', 'tanggal_sampai', 'nama_pupuk', 'diajukan_oleh', 'status_validasi']))
                            <strong>Tidak ada data validasi yang sesuai dengan filter.</strong>
                        @else
                            <strong>Tidak ada data pengajuan validasi saat ini.</strong>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($validations->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                {{-- DIUBAH: Menggunakan $validations --}}
                Menampilkan {{ $validations->firstItem() }} - {{ $validations->lastItem() }} dari {{ $validations->total() }} data
            </div>
            
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($validations->onFirstPage())
                        <li class="disabled"><span>‹ Sebelumnya</span></li>
                    @else
                        {{-- DIUBAH: Menggunakan $validations dan mempertahankan query filter --}}
                        <li><a href="{{ $validations->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($validations->links()->elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $validations->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url . '&' . http_build_query(request()->except('page')) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($validations->hasMorePages())
                        <li><a href="{{ $validations->appends(request()->query())->nextPageUrl() }}" rel="next">Selanjutnya ›</a></li>
                    @else
                        <li class="disabled"><span>Selanjutnya ›</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
@endsection
