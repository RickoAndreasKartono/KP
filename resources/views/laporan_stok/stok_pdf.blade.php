<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Tahun {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Stok Masuk Tahun {{ $tahun }}</h2>
    <table>
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
            @foreach ($stokMasuk as $index => $stok)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stok->nama_pupuk }}</td>
                    <td>{{ $stok->jumlah }}</td>
                    <td>{{ $stok->satuan }}</td>
                    <td>{{ $stok->pemasok }}</td>
                    <td>{{ \Carbon\Carbon::parse($stok->tanggal_masuk)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
