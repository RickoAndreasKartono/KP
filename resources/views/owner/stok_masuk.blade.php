@extends('layouts.owner')

@section('title', 'Stok Pupuk - Owner')

@section('section-header')
<div class="d-flex justify-content-between align-items-center mb-3"> {{-- Added Bootstrap flex classes directly here --}}
    <h2>Stok Pupuk</h2>
    <div class="d-flex align-items-center gap-3 flex-wrap"> {{-- Removed 'controls' class as it's not needed with Bootstrap --}}
        <form action="{{ route('stok_pupuk') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Cari Nama Pupuk" class="form-control me-2" style="min-width: 280px;">
            <button type="submit" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <a href="{{ route('stok_pupuk') }}" class="btn btn-success d-flex align-items-center gap-2"> {{-- Changed route and text to 'Tambah Pupuk' --}}
            <i class="fas fa-plus"></i>
            <span>Tambah Pupuk</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div id="stok-pupuk" class="container active">
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Pupuk</th>
                <th>Jumlah Tersedia</th>
                <th>Lokasi Simpan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{ asset('images/pupuk-urea.jpg') }}" alt="Pupuk Urea" width="50" height="50"></td>
                <td>Pupuk Urea (N)</td>
                <td>20</td>
                <td>Gudang A</td>
                <td>
                    <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection