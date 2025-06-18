@extends('layouts.kepala_admin')
@section('title', 'Buat Pengajuan Pembelian')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem; }
    .btn { display: inline-block; font-weight: 400; text-align: center; border: 1px solid transparent; padding: .375rem .75rem; font-size: 1rem; line-height: 1.5; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; border-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; border-color: #6c757d; }
</style>

<div class="card">
    <div class="card-header">Form Pengajuan Pembelian Baru</div>
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

        <form action="{{ route('kepala_admin.manajemen_pembelian.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pupuk">Nama Pupuk</label>
                <input type="text" name="nama_pupuk" class="form-control" value="{{ old('nama_pupuk') }}" required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah (Karung)</label>
                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required min="1">
            </div>

            <!-- Ganti input text satuan dengan dropdown -->
            <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control" id="satuan" name="satuan" required>
            <option value="">Pilih Satuan</option>
                @foreach($satuanOptions as $value => $label)
                <option value="{{ $value }}" {{ old('satuan') == $value ? 'selected' : '' }}>
                {{ $label }}
                </option>
            @endforeach
            </select>
        </div>

            {{-- DIUBAH: Input Pemasok menjadi Dropdown --}}
            <div class="form-group">
                <label for="id_pemasok">Nama Pemasok</label>
                <select name="id_pemasok" id="id_pemasok" class="form-control" required>
                    <option value="">-- Pilih Pemasok --</option>
                    {{-- Variabel $pemasokList dikirim dari Controller --}}
                    @foreach ($pemasokList as $pemasok)
                        <option value="{{ $pemasok->id_pemasok }}" {{ old('id_pemasok') == $pemasok->id_pemasok ? 'selected' : '' }}>
                            {{ $pemasok->nama_pemasok }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                <input type="date" name="tanggal_pembelian" class="form-control" value="{{ old('tanggal_pembelian', date('Y-m-d')) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            <a href="{{ route('kepala_admin.manajemen_pembelian.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
