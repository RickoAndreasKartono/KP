@extends('layouts.owner')

@section('title', 'Laporan Validasi Transaksi')

@section('content')
<style>
    /* Styling lengkap untuk halaman laporan dan filter */
    .container { padding: 20px; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .page-title { font-size: 28px; font-weight: 400; color: #5a5c69; }
    
    /* ====================================================== */
    /* CSS FILTER MODERN - PUTIH BERSIH SESUAI GAMBAR        */
    /* ====================================================== */
    .filter-card { 
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .filter-row {
        display: flex;
        align-items: end;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 200px;
        flex: 1;
    }
    
    .filter-label {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .filter-input, .filter-select {
        height: 48px;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #ffffff;
        color: #374151;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }
    
    .filter-input::placeholder {
        color: #9ca3af;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .filter-select option {
        background: #ffffff;
        color: #374151;
    }
    
    .filter-actions {
        display: flex;
        gap: 12px;
        align-items: end;
    }
    
    .btn-modern {
        height: 48px;
        padding: 0 24px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        box-sizing: border-box;
    }
    
    .btn-filter {
        background: #3b82f6;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
    }
    
    .btn-filter:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }
    
    .btn-reset {
        background: #6b7280;
        color: #ffffff;
        border: 1px solid #6b7280;
    }
    
    .btn-reset:hover {
        background: #4b5563;
        color: #ffffff;
        transform: translateY(-1px);
    }
    
    /* Icon untuk tombol */
    .btn-icon {
        width: 16px;
        height: 16px;
        fill: currentColor;
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

    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-group {
            min-width: auto;
        }
        
        .filter-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-modern {
            justify-content: center;
        }
    }
    /* ====================================================== */
    /* AKHIR DARI CSS FILTER MODERN                         */
    /* ====================================================== */

    .table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #fff; }
    .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
    .table th { background-color: #4A5568; color: #FFFFFF; }
    .status-badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .status-validated { background-color: #d4edda; color: #155724; }
    .status-rejected { background-color: #f8d7da; color: #721c24; }
    
    .pagination-wrapper { margin-top: 2rem; display: flex; justify-content: space-between; align-items: center; }
    .pagination-info { font-size: 0.9rem; color: #6c757d; }
    .pagination { display: flex; padding-left: 0; list-style: none; gap: 5px; }
    .pagination li span, .pagination li a { display: block; padding: 0.5rem 0.9rem; text-decoration: none; color: #007bff; background-color: #fff; border: 1px solid #dee2e6; border-radius: 0.25rem; }
    .pagination li a:hover { background-color: #e9ecef; }
    .pagination li.active span { color: #fff; background-color: #007bff; border-color: #007bff; }
    .pagination li.disabled span { color: #6c757d; pointer-events: none; }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="page-title">Laporan Validasi Transaksi</h2>
    </div>

    <div class="filter-card">
        <form method="GET" action="{{ route('owner.validasi_transaksi') }}">
                            <div class="filter-row">
                    <!-- Filter Tanggal Dari -->
                    <div class="filter-group">
                        <label class="filter-label">Tanggal Dari</label>
                        <input type="date" 
                               name="tanggal_dari" 
                               class="filter-input" 
                               value="{{ request('tanggal_dari') }}">
                    </div>
                    
                    <!-- Filter Tanggal Sampai -->
                    <div class="filter-group">
                        <label class="filter-label">Tanggal Sampai</label>
                        <input type="date" 
                               name="tanggal_sampai" 
                               class="filter-input" 
                               value="{{ request('tanggal_sampai') }}">
                    </div>
                    
                    <!-- Filter Status -->
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select name="status_validasi" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status_validasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="validated" {{ request('status_validasi') == 'validated' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ request('status_validasi') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="filter-actions">
                        <button type="submit" class="btn-modern btn-filter">
                            <svg class="btn-icon" viewBox="0 0 24 24">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('owner.validasi_transaksi') }}" class="btn-modern btn-reset">
                            <svg class="btn-icon" viewBox="0 0 24 24">
                                <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z"/>
                            </svg>
                            Reset
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

   
    <div class="notification-bar">
        <i class="fas fa-info-circle"></i> {{ $notificationMessage }}
    </div>


    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th>Detail</th>
                    <th>Diajukan Oleh</th>
                    <th>Tanggal Diajukan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($validations as $validasi)
                    <tr>
                        <td style="text-align: center;">{{ $validations->firstItem() + $loop->index }}</td>
                        <td>
                            @if ($pembelian = $validasi->pembelian)
                                <strong>{{ $pembelian->nama_pupuk }}</strong> ({{ $pembelian->jumlah }} {{ $pembelian->satuan }})
                                <br><small>Pemasok: {{ $pembelian->pemasok->nama_pemasok ?? 'N/A' }}</small>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $validasi->user->nama_user ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($validasi->created_at)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($validasi->status_validasi) }}">
                                {{ $validasi->status_validasi == 'validated' ? 'Disetujui' : ucfirst($validasi->status_validasi) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Tidak ada data validasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (Sama seperti kodemu yang manual, tidak diubah) --}}
    @if(isset($validations) && $validations->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan {{ $validations->firstItem() }} - {{ $validations->lastItem() }} dari {{ $validations->total() }} data
            </div>
            <nav>
                <ul class="pagination">
                    @if ($validations->onFirstPage())
                        <li class="disabled"><span>‹ Sebelumnya</span></li>
                    @else
                        <li><a href="{{ $validations->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif
                    @foreach ($validations->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $validations->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $validations->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
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