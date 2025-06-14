@extends('layouts.kepala_admin')

@section('title', 'Data Pemasok - Kepala Admin')

@section('section-header')
<div class="section-header">
  <h2>Data Pemasok</h2>
  <div class="controls-right">
    <a href="{{ route('kepala_admin.pemasok.add') }}" class="add-btn">
      <i class="fas fa-plus"></i> Tambah
    </a>
    <form method="GET" action="{{ route('kepala_admin.pemasok') }}" class="search-bar">
      <input type="text" name="search" placeholder="Cari Nama..." value="{{ request('search') }}">
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
        <th>ID Pemasok</th>
        <th>Nama Pemasok</th>
        <th>Alamat</th>
        <th>No. Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($pemasoks as $pemasok)
      <tr>
        <td>{{ $pemasok->id_pemasok }}</td>
        <td>{{ $pemasok->nama_pemasok }}</td>
        <td>{{ $pemasok->alamat }}</td>
        <td>{{ $pemasok->telepon }}</td>
        <td>
          <form method="POST" action="{{ route('kepala_admin.pemasok.delete', $pemasok->id_pemasok) }}" onsubmit="return confirm('Yakin ingin menghapus pemasok ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pemasok">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6">Belum ada data pemasok.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
