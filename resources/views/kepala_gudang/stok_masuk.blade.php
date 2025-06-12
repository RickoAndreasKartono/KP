@extends('layouts.kepala_gudang')

@section('title', 'Daftar Stok Pupuk - Kepala Gudang')

@section('section-header')
<div class="section-header">
  <h1>Daftar Stok Pupuk</h1>
  <div class="section-header-breadcrumb">
    {{-- Tombol ini mengarah ke halaman form tambah stok --}}
    <a href="{{ route('stok_masuk.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Stok Masuk</a>
  </div>
</div>
@endsection

@section('content')

{{-- Menampilkan notifikasi sukses atau error --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-header">
    <h4>Data Ketersediaan Pupuk</h4>
    <div class="card-header-form">
      <form>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Cari...">
          <div class="input-group-btn">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            {{-- PERUBAHAN: Mengganti 'Gambar' menjadi 'No.' --}}
            <th>No.</th>
            <th>Nama Pupuk</th>
            <th>Jumlah Tersedia</th>
            <th>Lokasi Simpan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {{-- Membuat tabel menjadi dinamis untuk menampilkan semua data --}}
          @forelse ($allPupuk as $index => $pupuk)
            <tr>
              {{-- PERUBAHAN: Menampilkan nomor urut --}}
              <td>{{ $index + 1 }}</td>
              <td>{{ $pupuk->nama_pupuk }}</td>
              <td>{{ $pupuk->jumlah_tersedia }}</td>
              <td>{{ $pupuk->lokasi_simpan }}</td>
              <td>
                <a href="#" class="btn btn-secondary btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Data pupuk belum tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
