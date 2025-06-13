@extends('layouts.kepala_gudang')

@section('title', 'Edit Data Master Pupuk')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; color: #495057; background-color: #fff; border: 1px solid #ced4da; border-radius: .25rem; }
    .btn { display: inline-block; padding: .375rem .75rem; font-size: 1rem; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Form Edit Data Pupuk</div>
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

            <form action="{{ route('kepala_gudang.stok_masuk.update', $pupuk->id_pupuk) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_pupuk">Nama Pupuk</label>
                    <input type="text" name="nama_pupuk" class="form-control" value="{{ old('nama_pupuk', $pupuk->nama_pupuk) }}" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_tersedia">Jumlah Tersedia</label>
                    <input type="number" name="jumlah_tersedia" class="form-control" value="{{ old('jumlah_tersedia', $pupuk->jumlah_tersedia) }}" required min="0">
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="{{ old('satuan', $pupuk->satuan) }}" required>
                </div>
                
            
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kepala_gudang.stok_masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
