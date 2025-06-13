{{-- Layout akan menyesuaikan secara dinamis dengan role yang login --}}
@extends('layouts.' . Auth::user()->role)

@section('title', 'Riwayat Stok Masuk - ' . ucfirst(Auth::user()->role))

@section('section-header')
  <div class="section-header">
    <h2>Riwayat Stok Masuk</h2>
    <div class="controls-right">
      {{-- Form pencarian yang fungsional dan dinamis --}}
      <form action="{{ route(Auth::user()->role . '.stok_masuk') }}" method="GET" class="search-form">
        <div class="search-bar">
          <input type="text" name="search" placeholder="Cari Nama Pupuk..." value="{{ request('search') }}">
          <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('content')
<div id="stok-masuk" class="container active">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pupuk</th>
        <th>Jumlah Masuk</th>
        <th>Tanggal Masuk</th>
        <th>Diinput Oleh</th>
      </tr>
    </thead>
    <tbody>
      {{-- Pastikan controller mengirim variabel dengan nama $stokMasuk --}}
      @forelse($stokMasuk as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->pupuk->nama_pupuk ?? 'Data Pupuk Dihapus' }}</td>
          <td>{{ $item->jumlah_masuk }} {{ $item->pupuk->satuan ?? '' }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
          <td>{{ $item->user->nama_user ?? 'Tidak diketahui' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5" style="text-align: center; padding: 20px;">
            @if(request('search'))
              Data untuk "{{ request('search') }}" tidak ditemukan.
            @else
              Belum ada data stok masuk.
            @endif
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
