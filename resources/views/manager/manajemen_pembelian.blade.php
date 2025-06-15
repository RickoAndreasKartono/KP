@extends('layouts.manager') {{-- Ganti layout sesuai role Manager --}}

@section('title', 'Validasi Pembelian')

@section('content')
<div class="container">
    <h2>Validasi Pengajuan Pembelian</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pupuk</th>
                <th>Jumlah</th>
                <th>Pemasok</th>
                <th>Tanggal Pembelian</th>
                <th>Status</th>
                <th>Diajukan Oleh</th>
                <th>Validasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelians as $pembelian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembelian->nama_pupuk }}</td>
                    <td>{{ $pembelian->jumlah }} {{ $pembelian->satuan }}</td>
                    <td>{{ $pembelian->pemasok->nama_pemasok }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->isoFormat('D MMMM Y') }}</td>
                    <td>
                        <span style="font-weight: bold; color: {{ $pembelian->status == 'pending' ? '#ffc107' : ($pembelian->status == 'disetujui' ? '#28a745' : '#dc3545') }}">
                            {{ ucfirst($pembelian->status) }}
                        </span>
                    </td>
                    <td>{{ $pembelian->user->nama_user ?? 'N/A' }}</td>
                    <td>
                        @if ($pembelian->status == 'pending')
                            <form action="{{ route('manager.manajemen_pembelian.validasi', $pembelian->id_pembelian) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" name="action" value="validasi" class="btn btn-success">Setujui</button>
                                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">Tidak ada pengajuan pembelian.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
