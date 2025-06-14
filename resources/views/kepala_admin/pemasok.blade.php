@extends('layouts.kepala_admin')

@section('title', 'Pemasok - Kepala Admin')

@section('section-header')
<div class="section-header">
    <h2>Data Pemasok</h2>
    <div class="controls-right">
        <a href="{{ route('kepala_admin.pemasok.add') }}" class="add-btn">
            <i class="fas fa-plus"></i> Tambah Pemasok
        </a>
        <form method="GET" action="{{ route('kepala_admin.pemasok') }}" class="search-bar">
            <input type="text" name="search" placeholder="Cari Nama..." value="{{ request('search') }}"> {{-- Ubah placeholder --}}
        </form>
    </div>
</div>
@endsection

@section('content')
<div id="pemasok" class="container active">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemasok</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th> 
            </tr>
        </thead>
        <tbody>
            @forelse($pemasoks as $index => $pemasok) 
            <tr>
                <td>{{ $index + 1 }}</td> {{-- Tampilkan nomor urut --}}
                <td>{{ $pemasok->nama_pemasok }}</td>
                <td>{{ $pemasok->alamat }}</td>
                <td>{{ $pemasok->telepon }}</td>
                <td>
                  {{-- TOMBOL EDIT --}}
                  <form method="GET" action="{{ route('kepala_admin.pemasok.edit', $pemasok->id_pemasok) }}">
                      @csrf
                      <button type="submit" class="btn-table-action btn-edit-user" title="Edit Pemasok">
                          <i class="fas fa-pencil-alt"></i>
                      </button>
                  </form>

                  {{-- FORM DELETE --}}
                  <form method="POST" action="{{ route('kepala_admin.pemasok.delete', $pemasok->id_pemasok) }}" class="delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-table-action btn-delete-user" title="Hapus Pemasok">
                          <i class="fas fa-trash"></i>
                      </button>
                  </form>
                </td>

              
  
              
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data pemasok.</td> 
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
