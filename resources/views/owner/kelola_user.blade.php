@extends('layouts.owner')

@section('title', 'Kelola User - Owner')

@section('section-header')
<div class="section-header">
    <div class="section-header-left">
        <h2>Kelola User</h2>
        
        {{-- Search Bar dipindahkan ke sebelah judul --}}
        <form method="GET" action="{{ route('owner.kelola_user') }}" class="search-bar">
            <input type="text" name="search" placeholder="Cari nama user..." value="{{ request('search') }}"
             autocomplete="off">
            <button type="submit" title="Cari">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    
    <div class="controls-right">
        <a href="{{ route('owner.kelola_user.add') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            <span>Tambah User</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('owner.kelola_user.update_role', $user->id_user) }}" class="update-role-form">
                        @csrf
                        <select name="role" onchange="this.form.submit()">
                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
                            <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('owner.kelola_user.delete', $user->id_user) }}" class="delete-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
                <td colspan="5" style="padding: 20px; text-align: center; font-style: italic; color: #666;">
                    @if(request('search'))
                        Tidak ada user yang ditemukan dengan kata kunci "{{ request('search') }}".
                    @else
                        Belum ada data user.
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Jika ada pagination --}}
    @if(method_exists($users, 'links'))
        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $users->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection