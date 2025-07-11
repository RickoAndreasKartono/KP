@extends('layouts.kepala_admin')
@section('title', 'Edit Pemasok')

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
    <div class="card-header">Form Edit Pemasok</div>
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

        <form action="{{ route('kepala_admin.pemasok.update', $pemasok->id_pemasok) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_pemasok">Nama Pemasok</label>
                <input type="text" name="nama_pemasok" class="form-control" value="{{ old('nama_pemasok', $pemasok->nama_pemasok) }}" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pemasok->alamat) }}</textarea>
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $pemasok->no_telepon) }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('kepala_admin.pemasok.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
