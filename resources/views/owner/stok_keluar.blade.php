<<<<<<< HEAD
@extends('layouts.owner')

@section('title', 'Stok Keluar - Owner')

@section('section-header')
<div class="section-header">
  <h2>Stok Keluar</h2>
  <div class="controls">
    <div class="add-btn">
      <i class="fas fa-plus"></i> Tambah
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Cari...">
    </div>
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
=======
@extends('layouts.main')

@section('title', 'Stok Keluar')

@section('content')
<div id="stok-keluar" class="container active">
  <h2>Data Stok Keluar</h2>
  <!-- Tambahkan konten stok keluar -->
>>>>>>> 2f4d4d1fa6f50e5a6d349fa1752a3f5573d7e9f7
</div>
@endsection
