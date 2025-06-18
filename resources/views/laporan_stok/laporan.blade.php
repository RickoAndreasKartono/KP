@extends('layouts.kepala_admin')

@section('content')
<div class="container">
    <h2>Laporan Stok Masuk per Tahun</h2>

    <form method="GET" action="{{ route('laporan_stok.laporan') }}" class="mb-4">
        <label for="tahun">Pilih Tahun:</label>
        <select name="tahun" id="tahun" required>
            <option value="">-- Pilih Tahun --</option>
            @foreach ($semuaTahun as $t)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
        </select>
        <button type="submit">Tampilkan</button>
        @if($tahun)
        <a href="{{ route('laporan_stok.stok_pdf', ['tahun' => $tahun]) }}" class="btn btn-danger" target="_blank">Download PDF</a>
        @endif
    </form>

    @if ($tahun && count($stokMasuk))
        <h5>Hasil Laporan Tahun: {{ $tahun }}</h5>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pupuk</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Pemasok</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stokMasuk as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->pupuk->nama_pupuk ?? '-' }}</td>
                    <td>{{ $item->jumlah_masuk }}</td>
                    <td>{{ $item->pupuk->satuan ?? '-' }}</td>
                    <td>{{ $item->pemasok->nama_pemasok ?? '-' }}</td>
                    <td>{{ $item->tanggal_masuk }}</td>
                </tr>
                @endforeach


            </tbody>
        </table>
    @elseif($tahun)
        <p>Tidak ada data stok untuk tahun {{ $tahun }}.</p>
    @endif
</div>
@endsection
