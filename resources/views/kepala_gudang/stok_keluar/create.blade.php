@extends('layouts.kepala_gudang')

@section('title', 'Catat Stok Keluar')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; color: #495057; border: 1px solid #ced4da; border-radius: .25rem; }
    .btn { display: inline-block; padding: .375rem .75rem; font-size: 1rem; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Form Catat Stok Keluar</div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('kepala_gudang.stok_keluar.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_pupuk">Pilih Pupuk</label>
                    <select name="id_pupuk" id="id_pupuk" class="form-control" required>
                        <option value="">-- Pilih Pupuk --</option>
                        @foreach ($daftarPupuk as $pupuk)
                            <option value="{{ $pupuk->id_pupuk }}" {{ old('id_pupuk') == $pupuk->id_pupuk ? 'selected' : '' }}>
                                {{ $pupuk->nama_pupuk }} (Stok: {{ $pupuk->jumlah_tersedia }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_keluar">Jumlah Keluar</label>
                    <input type="number" name="jumlah_keluar" class="form-control" value="{{ old('jumlah_keluar') }}" required min="1">
                </div>
                <div class="form-group">
                    <label for="tanggal_keluar">Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar', date('Y-m-d')) }}" required>
                </div>
                
                {{-- DIPERBAIKI: Nama field disesuaikan menjadi 'tujuan' agar cocok dengan database --}}
                <div class="form-group">
                    <label for="tujuan">Tujuan</label>
                    <textarea name="tujuan" id="tujuan" class="form-control" rows="3" placeholder="Contoh: Lahan Blok C, Proyek A">{{ old('tujuan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kepala_gudang.stok_keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
