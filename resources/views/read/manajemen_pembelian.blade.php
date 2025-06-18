{{-- File ini khusus untuk tampilan read-only oleh Owner dan Kepala Gudang --}}
@extends('layouts.' . Auth::user()->role)

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
    .btn-info {
        color: #fff;
        background-color: #36b9cc;
        border-color: #36b9cc;
    }
    .btn-info:hover {
        background-color: #2c9faf;
        border-color: #2a96a5;
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
    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d7ff;
        color: #004085;
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
    .status-selesai {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    
    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    .badge-info { 
        color: #fff; 
        background-color: #36b9cc; 
    }
    .badge-primary { 
        color: #fff; 
        background-color: #4e73df; 
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

    .text-muted {
        color: #858796 !important;
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
        <h2 class="page-title">
            @if(Auth::user()->hasRole('owner'))
                Laporan Manajemen Pembelian (Semua Data)
            @elseif(Auth::user()->hasRole('kepala_gudang'))
                Laporan Manajemen Pembelian (Data Tervalidasi)
            @elseif(Auth::user()->hasRole('manager'))
                Laporan Manajemen Pembelian
            @else
                Laporan Pembelian
            @endif
        </h2>
    </div>

    {{-- Filter Section --}}
    <div class="filter-card">
        <form method="GET" action="{{ request()->url() }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="search">Cari Pupuk / Pemasok</label>
                    <input type="text" 
                           name="search" 
                           id="search" 
                           value="{{ request('search') }}"
                           placeholder="Masukkan kata kunci..."
                           class="form-control">
                </div>
                
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
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        @if(!Auth::user()->hasRole('kepala_gudang'))
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        @endif
                        <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ request()->url() }}" class="btn btn-reset">
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
    @if(request()->hasAny(['search', 'tanggal_dari', 'tanggal_sampai', 'status']))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> 
            Menampilkan hasil filter: 
            @if(request('search'))
                <strong>Pencarian:</strong> "{{ request('search') }}"
            @endif
            @if(request('tanggal_dari'))
                <strong>Dari:</strong> {{ \Carbon\Carbon::parse(request('tanggal_dari'))->isoFormat('D MMMM Y') }}
            @endif
            @if(request('tanggal_sampai'))
                <strong>Sampai:</strong> {{ \Carbon\Carbon::parse(request('tanggal_sampai'))->isoFormat('D MMMM Y') }}
            @endif
            @if(request('status'))
                <strong>Status:</strong> {{ ucfirst(request('status')) }}
            @endif
            @if(isset($pembelians) && $pembelians->total() > 0)
                - <strong>Total:</strong> {{ $pembelians->total() }} data
            @endif
        </div>
    @else
        @if(isset($pembelians) && $pembelians->total() > 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                Total data: <strong>{{ $pembelians->total() }}</strong> pembelian
            </div>
        @endif
    @endif

    <div class="table-responsive">
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
                </tr>
            </thead>
            <tbody>
                @forelse ($pembelians as $pembelian)
                    <tr>
                        <td>
                            @if(method_exists($pembelians, 'firstItem') && $pembelians->firstItem())
                                {{ ($pembelians->currentPage() - 1) * $pembelians->perPage() + $loop->iteration }}
                            @else
                                {{ $loop->iteration }}
                            @endif
                        </td>
                        <td>
                            <strong>{{ $pembelian->nama_pupuk }}</strong>
                        </td>
                        <td>{{ number_format($pembelian->jumlah) }} {{ $pembelian->satuan }}</td>
                        <td>{{ $pembelian->pemasok->nama_pemasok ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($pembelian->status) }}">
                                @if($pembelian->status == 'validated')
                                    Disetujui
                                @elseif($pembelian->status == 'pending')
                                    Pending
                                @elseif($pembelian->status == 'rejected')
                                    Ditolak
                                @elseif($pembelian->status == 'selesai')
                                    Selesai
                                @else
                                    {{ ucfirst($pembelian->status) }}
                                @endif
                            </span>
                        </td>
                        <td>{{ $pembelian->user->name ?? $pembelian->user->nama_user ?? 'System' }}</td>
                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::user()->hasRole('kepala_gudang') ? '8' : '7' }}" style="text-align: center; padding: 40px; color: #858796;">
                            <i class="fas fa-inbox fa-2x" style="margin-bottom: 10px; display: block;"></i>
                            @if(request()->hasAny(['search', 'tanggal_dari', 'tanggal_sampai', 'status']))
                                Tidak ada data yang sesuai dengan filter yang dipilih.
                            @else
                                Belum ada data pembelian.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($pembelians) && $pembelians->hasPages())
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
                        <li><a href="{{ $pembelians->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($pembelians->getUrlRange(1, $pembelians->lastPage()) as $page => $url)
                        @if ($page == $pembelians->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $pembelians->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($pembelians->hasMorePages())
                        <li><a href="{{ $pembelians->appends(request()->query())->nextPageUrl() }}" rel="next">Selanjutnya ›</a></li>
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
    // Validasi tanggal
    const tanggalDari = document.getElementById('tanggal_dari');
    const tanggalSampai = document.getElementById('tanggal_sampai');
    
    if (tanggalDari && tanggalSampai) {
        tanggalDari.addEventListener('change', function() {
            tanggalSampai.min = this.value;
        });
        
        tanggalSampai.addEventListener('change', function() {
            tanggalDari.max = this.value;
        });
        
        // Set initial min/max based on current values
        if (tanggalDari.value) {
            tanggalSampai.min = tanggalDari.value;
        }
        if (tanggalSampai.value) {
            tanggalDari.max = tanggalSampai.value;
        }
    }
    
    // Auto-submit form saat status berubah (opsional)
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            // Uncomment baris berikut jika ingin auto-submit
            // this.form.submit();
        });
    }
});
</script>
@endsection