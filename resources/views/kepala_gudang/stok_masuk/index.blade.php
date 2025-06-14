@extends('layouts.kepala_gudang')

@section('title', 'Daftar Stok Pupuk')

@section('content')
<style>
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
    .table th { background-color: #4A5568; color: #FFFFFF; }
    .btn { display: inline-block; padding: 8px 12px; margin: 2px; font-size: 14px; text-align: center; cursor: pointer; border: 1px solid transparent; border-radius: 4px; text-decoration: none; }
    .btn i { margin-right: 5px; }
    .btn-primary { color: #fff; background-color: #007bff; }
    .btn-warning { color: #212529; background-color: #ffc107; }
    .btn-danger { color: #fff; background-color: #dc3545; }
    .action-group { display: flex; gap: 5px; }
</style>

<div class="container">
    <div class="page-header">
        <h2>Data Stok Masuk</h2>
        <a href="{{ route('kepala_gudang.stok_masuk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pupuk Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPupuk as $pupuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pupuk->nama_pupuk }}</td>
                    <td><strong>{{ $pupuk->jumlah_tersedia }} {{ $pupuk->satuan }}</strong></td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('kepala_gudang.stok_masuk.edit', $pupuk->id_pupuk) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('kepala_gudang.stok_masuk.destroy', $pupuk->id_pupuk) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada data master pupuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
