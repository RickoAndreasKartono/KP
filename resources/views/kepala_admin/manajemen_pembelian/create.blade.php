
@extends('layouts.kepala_admin') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('title', 'Buat Pengajuan Pembelian')

@section('content')
<style>
    /* Anda bisa memindahkan style ini ke file CSS terpusat */
    .container { padding: 20px; }
    .card { border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; }
    .form-control.is-invalid { border-color: #dc3545; }
    .invalid-feedback { display: block; width: 100%; margin-top: .25rem; font-size: 80%; color: #dc3545; }
    .btn { display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; }
    .btn-primary { color: #fff; background-color: #007bff; border-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; border-color: #6c757d; }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            Form Pengajuan Pembelian Baru
        </div>
        <div class="card-body">
            <form action="{{ route('kepala_admin.manajemen_pembelian.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_pupuk">Nama Pupuk</label>
                    <input type="text" name="nama_pupuk" id="nama_pupuk" class="form-control @error('nama_pupuk') is-invalid @enderror" value="{{ old('nama_pupuk') }}" required>
                    @error('nama_pupuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" required min="1">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan (Contoh: Kg, Ton, Karung)</label>
                    <input type="text" name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan') }}" required>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pemasok">Nama Pemasok</label>
                    <select name="id_pemasok" class="form-control" required>
                        <option value="">-- Pilih Pemasok --</option>
                        @foreach ($pemasoks as $pemasok)
                            <option value="{{ $pemasok->id_pemasok }}">{{ $pemasok->nama_pemasok }}</option>
                        @endforeach
                    </select>
                    @error('pemasok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control @error('tanggal_pembelian') is-invalid @enderror" value="{{ old('tanggal_pembelian') }}" required>
                    @error('tanggal_pembelian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kepala_admin.manajemen_pembelian.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
