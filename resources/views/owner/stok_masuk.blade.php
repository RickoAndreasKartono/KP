@extends('layouts.owner')

@section('title', 'Stok Masuk - Owner')

@section('section-header')
  <div class="section-header">
    <h2>Input Stok Masuk</h2>
    <div class="controls-right">
      <a href="{{ route('add_stok_masuk') }}" class="add-btn">
        <i class="fas fa-plus"></i> Tambah
      </a>
      <div class="search-bar">
        <input type="text" placeholder="Cari...">
      </div>
    </div>
  </div>
@endsection

@section('content')
<div id="stok-masuk" class="container active">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table>
    <thead>
      <tr>
        <th>Nama Pupuk</th>
        <th>Jumlah Masuk</th>
        <th>Tanggal Masuk</th>
        <th>Diinput Oleh</th>
      </tr>
    </thead>
    <tbody>
      @forelse($stokMasuk as $item)
        <tr>
          <td>{{ $item->pupuk->nama_pupuk }}</td>
          <td>{{ $item->jumlah_masuk }} {{ $item->pupuk->satuan }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
          <td>{{ $item->user->nama_user ?? 'Tidak diketahui' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4">Belum ada data stok masuk.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
