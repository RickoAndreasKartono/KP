@extends('layouts.kepala_admin')
@section('title', 'Tambah Pemasok Baru')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; color: #495057; background-color: #fff; border: 1px solid #ced4da; border-radius: .25rem; }
    .btn { display: inline-block; padding: .375rem .75rem; font-size: 1rem; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; border: 1px solid #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; border: 1px solid #6c757d; }
</style>

<div class="card">
    <div class="card-header">Form Tambah Pemasok</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kepala_admin.pemasok.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pemasok">Nama Pemasok</label>
                <input type="text" name="nama_pemasok" class="form-control" value="{{ old('nama_pemasok') }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input 
                    type="text" 
                    name="no_telepon" 
                    id="no_telepon" 
                    class="form-control" 
                    placeholder="Masukkan telepon pemasok"
                    value="{{ old('no_telepon', isset($pemasok) ? $pemasok->no_telepon : '') }}"
                    maxlength="15"
                    required
                >


            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kepala_admin.pemasok.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const teleponInput = document.getElementById('no_telepon');

    teleponInput.addEventListener('input', function(e) {
      // Hanya izinkan angka
      this.value = this.value.replace(/[^0-9]/g, '');

      // Batasi maksimal 15 digit
      if (this.value.length > 15) {
        this.value = this.value.slice(0, 15);
      }
    });

  });
</script>

@endsection
