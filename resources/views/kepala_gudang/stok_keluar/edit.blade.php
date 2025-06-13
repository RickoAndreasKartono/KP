@extends('layouts.kepala_gudang')

@section('title', 'Edit Catatan Stok Keluar')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; color: #495057; border: 1px solid #ced4da; border-radius: .25rem; }
    .form-control[disabled] { background-color: #e9ecef; } /* Style untuk dropdown yang non-aktif */
    .btn { display: inline-block; padding: .375rem .75rem; font-size: 1rem; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Form Edit Stok Keluar</div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Form action mengarah ke route update --}}
            <form action="{{ route('kepala_gudang.stok_keluar.update', $stokKeluar->id_stok_keluar) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method spoofing untuk update --}}
                
                <div class="form-group">
                    <label for="id_pupuk">Pupuk</label>
                    {{-- Dropdown pupuk dibuat disabled karena tidak seharusnya diubah saat edit --}}
                    <select name="id_pupuk" id="id_pupuk" class="form-control" disabled>
                        <option>{{ $stokKeluar->pupuk->nama_pupuk ?? 'N/A' }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah_keluar">Jumlah Keluar</label>
                    <input type="number" name="jumlah_keluar" class="form-control" value="{{ old('jumlah_keluar', $stokKeluar->jumlah_keluar) }}" required min="1">
                </div>

                <div class="form-group">
                    <label for="tanggal_keluar">Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar', $stokKeluar->tanggal_keluar) }}" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan', $stokKeluar->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kepala_gudang.stok_keluar.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
