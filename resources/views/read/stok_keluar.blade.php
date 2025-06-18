{{-- Layout akan menyesuaikan secara dinamis dengan peran yang sedang login --}}
@extends('layouts.' . Auth::user()->role)

@section('title', 'Riwayat Stok Masuk')

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
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d7ff;
        color: #004085;
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
    
    /* Sortable header styling */
    .table th a {
        color: #FFFFFF;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
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
        <h2 class="page-title">Riwayat Stok Masuk</h2>
    </div>

    {{-- Filter Section --}}
    <div class="filter-card">
        <form method="GET" action="{{ request()->url() }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="search">Cari Pupuk / User</label>
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

    {{-- Info total data --}}
    @if(isset($stokKeluarHistory) && $stokKeluarHistory->total() > 0)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> 
            Total data: <strong>{{ $stokKeluarHistory->total() }}</strong> stok masuk
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nama_pupuk', 'sort_direction' => ($sortBy == 'nama_pupuk' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">
                            Nama Pupuk @if($sortBy == 'nama_pupuk') <i class="fas fa-sort-{{$sortDirection}}"></i> @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'jumlah_masuk', 'sort_direction' => ($sortBy == 'jumlah_masuk' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">
                            Jumlah @if($sortBy == 'jumlah_masuk') <i class="fas fa-sort-{{$sortDirection}}"></i> @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'tanggal_masuk', 'sort_direction' => ($sortBy == 'tanggal_masuk' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">
                            Tanggal Masuk @if($sortBy == 'tanggal_masuk') <i class="fas fa-sort-{{$sortDirection}}"></i> @endif
                        </a>
                    </th>
                    <th>Dicatat Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stokKeluarHistory as $item)
                    <tr>
                        <td>
                            @if(method_exists($stokKeluarHistory, 'firstItem') && $stokKeluarHistory->firstItem())
                                {{ ($stokKeluarHistory->currentPage() - 1) * $stokKeluarHistory->perPage() + $loop->iteration }}
                            @else
                                {{ $loop->iteration }}
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->pupuk->nama_pupuk ?? 'N/A' }}</strong>
                        </td>
                        <td>{{ number_format($item->jumlah_masuk) }} {{ $item->pupuk->satuan ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $item->user->name ?? $item->user->nama_user ?? 'System' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #858796;">
                            <i class="fas fa-inbox fa-2x" style="margin-bottom: 10px; display: block;"></i>
                            @if(request()->hasAny(['search', 'tanggal_dari', 'tanggal_sampai']))
                                Tidak ada data yang sesuai dengan filter yang dipilih.
                            @else
                                Belum ada data stok masuk.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($stokKeluarHistory) && $stokKeluarHistory->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan {{ $stokKeluarHistory->firstItem() }} - {{ $stokKeluarHistory->lastItem() }} dari {{ $stokKeluarHistory->total() }} data
            </div>
            
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($stokKeluarHistory->onFirstPage())
                        <li class="disabled"><span>‹ Sebelumnya</span></li>
                    @else
                        <li><a href="{{ $stokKeluarHistory->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($stokKeluaeHistory->getUrlRange(1, $stokKeluarHistory->lastPage()) as $page => $url)
                        @if ($page == $stokKeluarHistory->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $stokKeluarHistory->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($stokMasukHistory->hasMorePages())
                        <li><a href="{{ $stokKeluarHistory->appends(request()->query())->nextPageUrl() }}" rel="next">Selanjutnya ›</a></li>
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
});
</script>
@endsection