@extends('layouts.kepala_admin')
@section('title', 'Manajemen Pemasok')

@section('content')
<style>
    /* Styling sederhana untuk mempercantik tampilan */
    .container {
        padding: 20px;
    }
    
    /* DIPERBARUI: Style untuk header halaman */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #ddd;
    }

    .page-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
    }

    /* DIUBAH: Latar belakang putih dan shadow pada tabel dihapus */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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
    /* DIHAPUS: Efek hover yang mengubah latar belakang menjadi putih */
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
    .action-group { 
        display: flex; 
        gap: 5px; 
    }
</style>

<div class="container">
    <div class="page-header">
        <h2>Daftar Pemasok</h2>
        <a href="{{ route('kepala_admin.pemasok.create') }}" class="btn btn-primary">Tambah Pemasok</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemasok</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemasokList as $pemasok)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemasok->nama_pemasok }}</td>
                        <td>{{ $pemasok->alamat ?? '-' }}</td>
                        <td>{{ $pemasok->no_telepon ?? '-' }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('kepala_admin.pemasok.edit', $pemasok->id_pemasok) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kepala_admin.pemasok.destroy', $pemasok->id_pemasok) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemasok ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 1rem;">Belum ada data pemasok. Silakan tambah data baru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
