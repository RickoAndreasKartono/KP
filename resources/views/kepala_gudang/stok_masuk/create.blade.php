@extends('layouts.kepala_gudang')

@section('title', 'Proses Stok Masuk dari Pembelian')

@section('content')
<style>
    .card { border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .card-header { padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; font-weight: 600; }
    .card-body { padding: 20px; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control { display: block; width: 100%; padding: .375rem .75rem; font-size: 1rem; color: #495057; background-color: #fff; border: 1px solid #ced4da; border-radius: .25rem; }
    .form-control[disabled] { background-color: #e9ecef; }
    .btn { display: inline-block; padding: .375rem .75rem; font-size: 1rem; border-radius: .25rem; }
    .btn-primary { color: #fff; background-color: #007bff; }
    .btn-secondary { color: #fff; background-color: #6c757d; }
    .new-validation { background-color: #e8f5e8; font-weight: bold; }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">Form Proses Stok Masuk</div>
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

            <form action="{{ route('kepala_gudang.stok_masuk.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_pembelian">Pilih Pembelian yang Disetujui</label>
                    <select class="form-control" id="id_pembelian" name="id_pembelian" required>
                        <option value="">-- Pilih Pembelian --</option>
                        @foreach($pembelianDisetujui as $pembelian)
                            <option value="{{ $pembelian->id_pembelian }}" 
                                    data-jumlah="{{ $pembelian->jumlah }}"
                                    data-satuan="{{ $pembelian->satuan }}"
                                    @if($pembelian->is_new_validation) class="new-validation" @endif>
                                {{ $pembelian->nama_pupuk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jumlah_dipesan">Jumlah Dipesan</label>
                    <input type="text" id="jumlah_dipesan" class="form-control" placeholder="Akan terisi otomatis" disabled>
                </div>
                
                <div class="form-group">
                    <label for="jumlah_masuk">Jumlah Masuk (Yang Diterima)</label>
                    <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-control" value="{{ old('jumlah_masuk') }}" required min="1">
                </div>

                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Diterima</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Proses dan Tambah Stok</button>
                <a href="{{ route('kepala_gudang.stok_masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pembelianSelect = document.getElementById('id_pembelian');
        const jumlahDipesanInput = document.getElementById('jumlah_dipesan');
        const jumlahMasukInput = document.getElementById('jumlah_masuk');

        pembelianSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const jumlah = selectedOption.getAttribute('data-jumlah');
            const satuan = selectedOption.getAttribute('data-satuan');
            
            if (jumlah && satuan) {
                jumlahDipesanInput.value = `${jumlah} ${satuan}`;
                jumlahMasukInput.value = jumlah; 
            } else {
                jumlahDipesanInput.value = '';
                jumlahMasukInput.value = '';
            }
        });

        // Trigger change event jika ada value yang sudah terpilih sebelumnya
        if(pembelianSelect.value) {
            pembelianSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection