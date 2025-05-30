@extends('layouts.owner')

@section('title', 'Tambah Stok Masuk')

@section('section-header')
  <div class="section-header">
    <h2>Tambah Stok Masuk</h2>
  </div>
@endsection

@section('content')
<div class="container">
  <form action="{{ route('store_stok_masuk') }}" method="POST">
    @csrf
    <div style="margin-bottom: 15px;">
      <label for="id_pupuk">Pilih Pupuk:</label><br>
      <select name="id_pupuk" id="id_pupuk" required style="width: 100%; padding: 10px; border-radius: 8px;">
        <option value="">-- Pilih Pupuk --</option>
        @foreach($pupuk as $p)
          <option value="{{ $p->id }}">{{ $p->nama_pupuk }}</option>
        @endforeach
      </select>
    </div>

    <div style="margin-bottom: 15px;">
      <label for="jumlah_masuk">Jumlah Masuk:</label><br>
      <input type="number" name="jumlah_masuk" id="jumlah_masuk" required class="input" min="1" style="width: 100%; padding: 10px; border-radius: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
      <label for="tanggal_masuk">Tanggal Masuk:</label><br>
      <input type="date" name="tanggal_masuk" id="tanggal_masuk" required class="input" style="width: 100%; padding: 10px; border-radius: 8px;">
    </div>

    <div style="margin-top: 20px; display: flex; gap: 10px;">
      <button type="submit" class="add-btn">
        <i class="fas fa-check"></i> Done
      </button>
      <a href="{{ route('stok_masuk') }}" class="add-btn" style="background-color: #ccc; color: black;">
        <i class="fas fa-times"></i> Batal
      </a>
    </div>
  </form>
</div>
@endsection
