@extends('layouts.kepala_admin') {{-- Pastikan nama file layout ini sesuai dengan proyek Anda --}}

@section('title', 'Manajemen Pembelian')

@section('content')
<style>
    /* Styling sederhana untuk mempercantik tampilan */
    .container {
        padding: 20px;
    }
    
    /* Filter Card Styling */
    .filter-card {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: end;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
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
        transition: border-color 0.15s ease-in-out;
    }
    
    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .filter-buttons {
        display: flex;
        gap: 10px;
        align-items: end;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        background: #fff;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
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
        background-color: #4e73df;
        border-color: #4e73df;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }
    .btn-secondary {
        color: #fff;
        background-color: #858796;
        border-color: #858796;
    }
    .btn-secondary:hover {
        background-color: #717384;
        border-color: #6b6d7d;
    }
    .btn-warning {
        color: #212529;
        background-color: #f6c23e;
        border-color: #f6c23e;
    }
    .btn-warning:hover {
        background-color: #f4b619;
        border-color: #f4b30d;
    }
    .btn-danger {
        color: #fff;
        background-color: #e74a3b;
        border-color: #e74a3b;
    }
    .btn-danger:hover {
        background-color: #e02d1b;
        border-color: #dc281a;
    }
    .btn-success {
        color: #fff;
        background-color: #1cc88a;
        border-color: #1cc88a;
    }
    .btn-success:hover {
        background-color: #17a673;
        border-color: #169b6b;
    }
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
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
    
    /* Status Badge Styling */
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .status-validated, .status-disetujui {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .status-rejected, .status-ditolak {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f1b0b7;
    }
    
    /* Pagination Styling */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .pagination-info {
        color: #5a5c69;
        font-size: 14px;
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
        font-size: 14px;
        transition: all 0.2s ease-in-out;
    }
    
    .pagination li.active span {
        background-color: #4e73df;
        border-color: #4e73df;
        color: #fff;
    }
    
    .pagination li:not(.active) a:hover {
        background-color: #eaecf4;
        border-color: #c2c7d6;
    }
    
    .pagination li.disabled span {
        color: #b7b9cc;
        background-color: #f8f9fc;
        cursor: not-allowed;
    }
    
    /* Header section */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: 400;
        color: #5a5c69;
        margin: 0;
    }
    
    /* Reset button styling */
    .btn-reset {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }
    
    .btn-reset:hover {
        background-color: #545b62;
        border-color: #4e555b;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .filter-row {
            flex-direction: column;
        }
        
        .filter-group {
            min-width: 100%;
        }
        
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table {
            font-size: 12px;
        }
        
        .table th,
        .table td {
            padding: 8px;
        }
    }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="page-title">Daftar Pengajuan Pembelian</h2>
        {{-- Tombol untuk mengarahkan ke halaman tambah data --}}
        <a href="{{ route('kepala_admin.manajemen_pembelian.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Buat Pengajuan Baru
        </a>
    </div>

    {{-- Filter Section --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('kepala_admin.manajemen_pembelian.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="tanggal_dari">Tanggal Dari</label>
                    <input type="date" 
                           name="tanggal_dari" 
                           id="tanggal_dari" 
                           value="{{ request('tanggal_dari') }}"
                           class="form-control">
                </div>
                
                <div class="filter-group">
                    <label for="tanggal_sampai">Tanggal Sampai</label>
                    <input type="date" 
                           name="tanggal_sampai" 
                           id="tanggal_sampai" 
                           value="{{ request('tanggal_sampai') }}"
                           class="form-control">
                </div>
                
                <div class="filter-group">
                    <label for="nama_pupuk">Nama Pupuk</label>
                    <input type="text" 
                           name="nama_pupuk" 
                           id="nama_pupuk" 
                           value="{{ request('nama_pupuk') }}"
                           placeholder="Cari nama pupuk..."
                           class="form-control">
                </div>
                
                <div class="filter-group">
                    <label for="pemasok">Pemasok</label>
                    <input type="text" 
                           name="pemasok" 
                           id="pemasok" 
                           value="{{ request('pemasok') }}"
                           placeholder="Cari pemasok..."
                           class="form-control">
                </div>
                
                <div class="filter-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('kepala_admin.manajemen_pembelian.index') }}" class="btn btn-reset">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Notifikasi untuk pesan sukses atau error --}}
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

    {{-- Informasi hasil filter --}}
    @if(request()->hasAny(['tanggal_dari', 'tanggal_sampai', 'nama_pupuk', 'pemasok', 'status']))
        <div class="alert" style="background-color: #e7f3ff; border-color: #b3d7ff; color: #004085;">
            <i class="fas fa-info-circle"></i> 
            Menampilkan hasil filter: 
            @if(request('tanggal_dari'))
                <strong>Dari:</strong> {{ \Carbon\Carbon::parse(request('tanggal_dari'))->isoFormat('D MMMM Y') }}
            @endif
            @if(request('tanggal_sampai'))
                <strong>Sampai:</strong> {{ \Carbon\Carbon::parse(request('tanggal_sampai'))->isoFormat('D MMMM Y') }}
            @endif
            @if(request('nama_pupuk'))
                <strong>Pupuk:</strong> "{{ request('nama_pupuk') }}"
            @endif
            @if(request('pemasok'))
                <strong>Pemasok:</strong> "{{ request('pemasok') }}"
            @endif
            @if(request('status'))
                <strong>Status:</strong> {{ ucfirst(request('status')) }}
            @endif
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah Karung</th>
                <th>Berat (Kg)</th>
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
                    <td>{{ ($pembelians->currentPage() - 1) * $pembelians->perPage() + $loop->iteration }}</td>
                    <td>
                        <strong>{{ $pembelian->nama_pupuk }}</strong>
                    </td>
                    <td>{{ number_format($pembelian->jumlah) }} {{ $pembelian->satuan }}</td>
                    <td>{{ number_format($pembelian->jumlah * 50) }} Kg</td>
                    <td>{{ $pembelian->pemasok->nama_pemasok ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->isoFormat('D MMMM Y') }}</td>
                    <td>
                        {{-- Status badge dengan styling yang lebih menarik --}}
                        <span class="status-badge status-{{ $pembelian->status }}">
                            {{ ucfirst($pembelian->status) }}
                        </span>
                    </td>
                    <td>{{ $pembelian->user->nama_user ?? 'N/A' }}</td>
                    <td>
                        {{-- Tombol Aksi hanya muncul jika status masih 'pending' --}}
                        @if ($pembelian->status == 'pending')
                            <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                <a href="{{ route('kepala_admin.manajemen_pembelian.edit', ['manajemenPembelian' => $pembelian->id_pembelian]) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kepala_admin.manajemen_pembelian.destroy', ['manajemenPembelian' => $pembelian->id_pembelian]) }}" 
                                      method="POST" 
                                      style="display:inline-block;" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                {{-- Pesan jika tidak ada data sama sekali --}}
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: #858796;">
                        <i class="fas fa-inbox fa-2x" style="margin-bottom: 10px; display: block;"></i>
                        @if(request()->hasAny(['tanggal_dari', 'tanggal_sampai', 'nama_pupuk', 'pemasok', 'status']))
                            Tidak ada data yang sesuai dengan filter yang dipilih.
                        @else
                            Belum ada data pengajuan pembelian.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($pembelians->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan {{ $pembelians->firstItem() }} - {{ $pembelians->lastItem() }} dari {{ $pembelians->total() }} data
            </div>
            
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($pembelians->onFirstPage())
                        <li class="disabled"><span>‹ Sebelumnya</span></li>
                    @else
                        <li><a href="{{ $pembelians->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($pembelians->getUrlRange(1, $pembelians->lastPage()) as $page => $url)
                        @if ($page == $pembelians->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($pembelians->hasMorePages())
                        <li><a href="{{ $pembelians->nextPageUrl() }}" rel="next">Selanjutnya ›</a></li>
                    @else
                        <li class="disabled"><span>Selanjutnya ›</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>

{{-- JavaScript untuk enhance user experience --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form saat tanggal berubah (opsional)
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Uncomment line below if you want auto-submit on date change
            // this.form.submit();
        });
    });
    
    // Clear individual filter
    function clearFilter(inputName) {
        const input = document.querySelector(`[name="${inputName}"]`);
        if (input) {
            input.value = '';
        }
    }
    
    // Add clear buttons to each filter (if needed)
    // You can enhance this further by adding individual clear buttons
});
</script>
@endsection