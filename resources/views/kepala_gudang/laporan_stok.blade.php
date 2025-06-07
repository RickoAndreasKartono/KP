@extends('layouts.kepala_gudang')

@section('title', 'Laporan Stok - Kepala Gudang')

@section('section-header')
<div class="section-header">
  <h2>Laporan Stok</h2>
  <div class="controls">
    <div class="search-bar">
      <input type="text" placeholder="Cari...">
    </div>
  </div>
</div>
@endsection

@section('content')
<div id="stok-pupuk" class="container active">
  <div class="report-table">
    <table>
      <thead>
        <tr>
          <th>Foto Produk</th>
          <th>Nama Produk</th>
          <th>Stok Tersedia</th>
          <th>Lokasi Gudang</th>
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
            <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
            <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <!-- Tambahkan baris lain sesuai kebutuhan -->
      </tbody>
    </table>
  </div>
</div>
@endsection

