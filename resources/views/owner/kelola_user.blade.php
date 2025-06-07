@extends('layouts.owner')

@section('title', 'Kelola User - Owner')

@section('section-header')
<div class="section-header">
    <h2>Kelola User</h2>
    <div class="controls-right">
        <a href="{{ route('owner.kelola_user.add') }}" class="add-btn">
            <i class="fas fa-plus"></i> Tambah User
        </a>
        <form method="GET" action="{{ route('owner.kelola_user') }}" class="search-bar">
            <input type="text" name="search" placeholder="Cari Nama..." value="{{ request('search') }}"> {{-- Ubah placeholder --}}
        </form>
    </div>
</div>
@endsection

@section('content')
<div id="kelola-user" class="container active">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th> {{-- Ganti ID User menjadi No. --}}
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th> {{-- Hapus kolom Password (Hashed) --}}
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user) {{-- Tambahkan $index untuk nomor urut --}}
            <tr>
                <td>{{ $index + 1 }}</td> {{-- Tampilkan nomor urut --}}
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('owner.kelola_user.update_role', $user->id_user) }}" class="update-role-form">
                        @csrf
                        <select name="role" class="form-control form-control-sm">
                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
                            <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
                        </select>
                        <button type="submit" class="btn-table-action btn-update-role" title="Update Role">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </td>
                {{-- Kolom Password (Hashed) dihapus --}}
                <td>
                    {{-- SESUDAH --}}
                    <form method="POST" action="{{ route('owner.kelola_user.delete', $user->id_user) }}" class="delete-form"> {{-- Tambahkan class untuk identifikasi --}}
                @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-table-action btn-delete-user" title="Hapus User">
                     <i class="fas fa-trash"></i>
           </button>
    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data user.</td> {{-- Ubah colspan menjadi 5 karena ada 5 kolom sekarang --}}
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
