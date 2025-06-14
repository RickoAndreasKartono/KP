@extends('layouts.add')

@section('title', 'Edit Pemasok - Kepala Admin')

@section('section-header')
<div class="section-header">
  <h2>Edit Pemasok</h2>  
  <div class="controls-right">
    <a href="{{ route('kepala_admin.pemasok') }}" class="back-btn">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

@section('content')
<div class="form-container">
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Terjadi kesalahan:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('kepala_admin.pemasok.update', $pemasok->id_pemasok) }}">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="nama_pemasok">
        <i class="fas fa-user"></i> Nama Pemasok
      </label>
      <input 
        type="text" 
        name="nama_pemasok" 
        id="nama_pemasok" 
        class="form-control" 
        placeholder="Masukkan nama pemasok"
        value="{{ old('nama_pemasok', $pemasok->nama_pemasok) }}"
        required
      >
    </div>

    <div class="form-group">
      <label for="alamat">
        <i class="fas fa-map-marker-alt"></i> Alamat
      </label>
      <input 
        type="text" 
        name="alamat" 
        id="alamat" 
        class="form-control" 
        placeholder="Masukkan alamat pemasok"
        value="{{ old('alamat', $pemasok->alamat) }}"
        required
      >
    </div>

    <div class="form-group">
      <label for="telepon">
        <i class="fas fa-phone"></i> No. Telepon
      </label>
      <input 
        type="tel" 
        name="telepon" 
        id="telepon" 
        class="form-control" 
        placeholder="Masukkan telepon pemasok"
        value="{{ old('telepon', $pemasok->telepon) }}"
        pattern="[0-9]{1,15}" 
        title="Harus berupa angka dan maksimal 15 digit"
        required
      >
    </div>

    <div class="form-footer">
      <button type="submit" class="submit-btn">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nama_pemasok').focus();
  });
</script>
@endsection
