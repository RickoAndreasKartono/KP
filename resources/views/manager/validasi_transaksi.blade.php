@extends('layouts.manager')

@section('title', 'Validasi Transaksi - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <h2>Validasi Transaksi</h2>
  <div class="controls">
    <div class="search-bar">
      <input type="text" placeholder="Cari transaksi..." id="searchTransaction">
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <table>
    <thead>
      <tr>
        <th>ID Transaksi</th>
        <th>Nama Pelanggan</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="transactionTableBody">
      <tr>
        <td>#TX1234</td>
        <td>John Doe</td>
        <td>Pupuk Urea</td>
        <td>10</td>
        <td><span class="status pending">Menunggu Validasi</span></td>
        <td>
          <button class="action-btn validate-btn" title="Validasi"><i class="fas fa-check-circle"></i></button>
          <button class="action-btn cancel-btn" title="Batal"><i class="fas fa-times-circle"></i></button>
        </td>
      </tr>
      <tr>
        <td>#TX5678</td>
        <td>Jane Smith</td>
        <td>Pupuk NPK</td>
        <td>5</td>
        <td><span class="status validated">Tervalidasi</span></td>
        <td>
          <button class="action-btn validate-btn" title="Validasi" disabled><i class="fas fa-check-circle"></i></button>
          <button class="action-btn cancel-btn" title="Batal"><i class="fas fa-times-circle"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection