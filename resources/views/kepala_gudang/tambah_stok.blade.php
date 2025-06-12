@extends('layouts.kepala_gudang')

@section('title', 'Tambah Stok Masuk - Kepala Gudang')

@section('section-header')
<div class="section-header">
  <h1>Formulir Tambah Stok Masuk</h1>
</div>
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h4>Input Data Stok Masuk</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('stok_masuk.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="form-group col-md-6">
          <label for="id_pupuk">Nama Pupuk</label>
          <select id="id_pupuk" name="id_pupuk" class="form-control @error('id_pupuk') is-invalid @enderror" required>
            <option value="">-- Pilih Pupuk --</option>
            @foreach ($allPupuk as $pupuk)
              <option value="{{ $pupuk->id_pupuk }}" {{ old('id_pupuk') == $pupuk->id_pupuk ? 'selected' : '' }}>
                {{ $pupuk->nama_pupuk }} (Stok Saat Ini: {{ $pupuk->jumlah_tersedia }})
              </option>
            @endforeach
          </select>
          @error('id_pupuk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="tanggal_masuk">Tanggal Masuk</label>
          <input id="tanggal_masuk" type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
          @error('tanggal_masuk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="jumlah_masuk">Jumlah Masuk (Kg/Satuan)</label>
          <input id="jumlah_masuk" type="number" class="form-control @error('jumlah_masuk') is-invalid @enderror" name="jumlah_masuk" value="{{ old('jumlah_masuk') }}" placeholder="Contoh: 100" required>
          @error('jumlah_masuk')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="card-footer text-right">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kepala_gudang.stok_masuk') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>

@endsection
