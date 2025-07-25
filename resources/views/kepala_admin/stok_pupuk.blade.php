@extends('layouts.kepala_admin')

@section('title', 'Stok Pupuk - Kepala Admin')

@section('content')
<div id="stok_pupuk" class="container active">
  <h2>Data Stok Pupuk</h2>
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
