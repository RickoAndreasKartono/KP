@extends('layouts.' . Auth::user()->role)

@section('title', 'Data Stok Pupuk')

@section('content')
<style>
    /* Styling lengkap untuk halaman stok pupuk */
    .container { padding: 20px; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .page-title { font-size: 28px; font-weight: 400; color: #5a5c69; }
    
    /* ====================================================== */
    /* CSS FILTER & CONTROL MODERN - PUTIH BERSIH            */
    /* ====================================================== */
    .control-card { 
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .control-row {
        display: flex;
        align-items: end;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    
    .control-group {
        display: flex;
        flex-direction: column;
        min-width: 200px;
        flex: 1;
    }
    
    .control-label {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .control-input, .control-select {
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
    
    .control-input::placeholder {
        color: #9ca3af;
    }
    
    .control-input:focus, .control-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .control-select option {
        background: #ffffff;
        color: #374151;
    }
    
    .control-actions {
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
    
    .btn-search {
        background: #3b82f6;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
    }
    
    .btn-search:hover {
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
    
    /* Styling untuk Notifikasi Bar */
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
        .control-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .control-group {
            min-width: auto;
        }
        
        .control-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-modern {
            justify-content: center;
        }
    }

    /* Table Styles */
    .table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 20px; 
        background-color: #fff;
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
        position: relative; 
    }
    
    /* Sorting styles */
    .sortable { 
        cursor: pointer; 
        user-select: none; 
        transition: background-color 0.3s ease;
    }
    .sortable:hover { 
        background-color: #5A6B7D; 
    }
    .sort-icon { 
        margin-left: 8px; 
        font-size: 12px; 
        opacity: 0.7;
    }
    .sortable.active .sort-icon {
        opacity: 1;
    }
    
    /* Pagination styles */
    .pagination-wrapper { 
        margin-top: 2rem; 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    }
    .pagination-info { 
        font-size: 0.9rem; 
        color: #6c757d; 
    }
    .pagination { 
        display: flex; 
        padding-left: 0; 
        list-style: none; 
        gap: 5px; 
    }
    .pagination li span, .pagination li a { 
        display: block; 
        padding: 0.5rem 0.9rem; 
        text-decoration: none; 
        color: #007bff; 
        background-color: #fff; 
        border: 1px solid #dee2e6; 
        border-radius: 0.25rem; 
    }
    .pagination li a:hover { 
        background-color: #e9ecef; 
    }
    .pagination li.active span { 
        color: #fff; 
        background-color: #007bff; 
        border-color: #007bff; 
    }
    .pagination li.disabled span { 
        color: #6c757d; 
        pointer-events: none; 
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .table { font-size: 14px; }
        .pagination-wrapper { 
            flex-direction: column; 
            gap: 10px; 
            align-items: center;
        }
    }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="page-title">Data Stok Pupuk</h2>
    </div>

    <!-- Control Card untuk Search dan Sort -->
    <div class="control-card">
        <form method="GET" action="{{ route(Auth::user()->role . '.stok_pupuk') }}">
            <div class="control-row">
                <!-- Search Input -->
                <div class="control-group">
                    <label class="control-label">Cari Pupuk</label>
                    <input type="text" 
                           name="search" 
                           class="control-input" 
                           placeholder="Masukkan nama pupuk..."
                           value="{{ request('search') }}">
                </div>
                
                <!-- Sort By -->
                <div class="control-group">
                    <label class="control-label">Urutkan Berdasarkan</label>
                    <select name="sort_by" class="control-select">
                        <option value="nama_pupuk" {{ request('sort_by', 'nama_pupuk') == 'nama_pupuk' ? 'selected' : '' }}>Nama Pupuk</option>
                        <option value="total_masuk" {{ request('sort_by') == 'total_masuk' ? 'selected' : '' }}>Total Masuk</option>
                        <option value="total_keluar" {{ request('sort_by') == 'total_keluar' ? 'selected' : '' }}>Total Keluar</option>
                        <option value="sisa_stok" {{ request('sort_by') == 'sisa_stok' ? 'selected' : '' }}>Sisa Stok</option>
                    </select>
                </div>
                
                <!-- Action Buttons -->
                <div class="control-actions">
                    <button type="submit" class="btn-modern btn-search">
                        <svg class="btn-icon" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Terapkan
                    </button>
                    <a href="{{ route(Auth::user()->role . '.stok_pupuk') }}" class="btn-modern btn-reset">
                        <svg class="btn-icon" viewBox="0 0 24 24">
                            <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Search Result Info -->
    @if(request('search'))
        <div class="notification-bar">
            <i class="fas fa-search"></i>
            Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
            @if(method_exists($daftarPupuk, 'total'))
                ({{ $daftarPupuk->total() }} data ditemukan)
            @else
                ({{ $daftarPupuk->count() }} data ditemukan)
            @endif
        </div>
    @else
        <div class="notification-bar">
            <i class="fas fa-info-circle"></i>
            @if(method_exists($daftarPupuk, 'total'))
                Menampilkan {{ $daftarPupuk->total() }} data stok pupuk
            @else
                Menampilkan {{ $daftarPupuk->count() }} data stok pupuk
            @endif
        </div>
    @endif

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th class="sortable {{ request('sort_by', 'nama_pupuk') == 'nama_pupuk' ? 'active' : '' }}" 
                        onclick="sortTable('nama_pupuk')">
                        Nama Pupuk
                        <span class="sort-icon">
                            @if(request('sort_by', 'nama_pupuk') == 'nama_pupuk')
                                <i class="fas fa-sort-up"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </span>
                    </th>
                    <th class="sortable {{ request('sort_by') == 'total_masuk' ? 'active' : '' }}" 
                        onclick="sortTable('total_masuk')">
                        Total Masuk
                        <span class="sort-icon">
                            @if(request('sort_by') == 'total_masuk')
                                <i class="fas fa-sort-down"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </span>
                    </th>
                    <th class="sortable {{ request('sort_by') == 'total_keluar' ? 'active' : '' }}" 
                        onclick="sortTable('total_keluar')">
                        Total Keluar
                        <span class="sort-icon">
                            @if(request('sort_by') == 'total_keluar')
                                <i class="fas fa-sort-down"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </span>
                    </th>
                    <th class="sortable {{ request('sort_by') == 'sisa_stok' ? 'active' : '' }}" 
                        onclick="sortTable('sisa_stok')">
                        Sisa Stok
                        <span class="sort-icon">
                            @if(request('sort_by') == 'sisa_stok')
                                <i class="fas fa-sort-down"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarPupuk as $pupuk)
                    <tr>
                        <td style="text-align: center;">
                            @if(method_exists($daftarPupuk, 'firstItem'))
                                {{ $daftarPupuk->firstItem() + $loop->index }}
                            @else
                                {{ $loop->iteration }}
                            @endif
                        </td>
                        <td>{{ $pupuk->nama_pupuk }}</td>
                        <td><strong>{{ number_format($pupuk->total_masuk) }} {{ $pupuk->satuan }}</strong></td>
                        <td><strong>{{ number_format($pupuk->total_keluar) }} {{ $pupuk->satuan }}</strong></td>
                        <td><strong>{{ number_format($pupuk->sisa_stok) }} {{ $pupuk->satuan }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px;">
                            @if(request('search'))
                                <i class="fas fa-search" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i><br>
                                Pupuk dengan nama "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                            @else
                                <i class="fas fa-seedling" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i><br>
                                Belum ada data stok pupuk.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(method_exists($daftarPupuk, 'hasPages') && $daftarPupuk->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan {{ $daftarPupuk->firstItem() }} - {{ $daftarPupuk->lastItem() }} dari {{ $daftarPupuk->total() }} data
            </div>
            <nav>
                <ul class="pagination">
                    @if ($daftarPupuk->onFirstPage())
                        <li class="disabled"><span>‹ Sebelumnya</span></li>
                    @else
                        <li><a href="{{ $daftarPupuk->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Sebelumnya</a></li>
                    @endif
                    @foreach ($daftarPupuk->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $daftarPupuk->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $daftarPupuk->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($daftarPupuk->hasMorePages())
                        <li><a href="{{ $daftarPupuk->appends(request()->query())->nextPageUrl() }}" rel="next">Selanjutnya ›</a></li>
                    @else
                        <li class="disabled"><span>Selanjutnya ›</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @elseif(!method_exists($daftarPupuk, 'hasPages') && $daftarPupuk->count() > 0)
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan semua {{ $daftarPupuk->count() }} data
            </div>
        </div>
    @endif
</div>

<script>
function sortTable(column) {
    // Build URL dengan parameter yang ada
    const params = new URLSearchParams(window.location.search);
    params.set('sort_by', column);
    
    // Redirect ke URL baru
    window.location.href = window.location.pathname + '?' + params.toString();
}

// Auto submit form when sort selection changes
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.querySelector('select[name="sort_by"]');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            this.form.submit();
        });
    }
});
</script>
@endsection