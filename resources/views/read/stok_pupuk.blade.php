@extends('layouts.' . Auth::user()->role)

@section('title', 'Data Stok Pupuk')

@section('section-header')
    <div class="section-header">
        <h2>Data Stok Pupuk</h2>
        <div class="controls-right">
            <form action="{{ route(Auth::user()->role . '.stok_pupuk') }}" method="GET" class="search-form">
                <div class="search-bar">
                    <input type="text" name="search" placeholder="Cari Nama Pupuk..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
<style>
    .container { padding: 20px; }
    .table { width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; vertical-align: middle; }
    .table th { background-color: #4A5568; color: #FFFFFF; font-weight: 600; }
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .search-form .search-bar { display: flex; border: 1px solid #ccc; border-radius: 5px; overflow: hidden; }
    .search-form input { border: none; padding: 8px 12px; font-size: 1rem; outline: none; }
    .search-form button { background: #f0f0f0; border: none; padding: 0 12px; cursor: pointer; }
</style>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
                <th>Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPupuk as $pupuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pupuk->nama_pupuk }}</td>
                    <td><strong>{{ $pupuk->total_masuk }} {{ $pupuk->satuan }}</strong></td>
                    <td><strong>{{ $pupuk->total_keluar }} {{ $pupuk->satuan }}</strong></td>
                    <td><strong>{{ $pupuk->sisa_stok }} {{ $pupuk->satuan }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        @if(request('search'))
                            Pupuk dengan nama "{{ request('search') }}" tidak ditemukan.
                        @else
                            Belum ada data master pupuk.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
