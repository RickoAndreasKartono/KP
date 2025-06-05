@extends('layouts.owner')

@section('title', 'Kelola User - CV Agro Citra Indonesia')

@section('section-header')
<div class="d-flex justify-content-between align-items-center w-100">
    <h2 class="text-primary fw-bold m-0">Kelola User</h2>

    <div class="d-flex align-items-center gap-3 flex-wrap">
        <!-- Search Form -->
        <form action="{{ route('kelola_user') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Cari Nama atau Email" class="form-control me-2" style="min-width: 280px;">
            <button type="submit" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- Tombol Tambah User -->
        <a href="{{ route('tambah_user') }}" class="btn btn-success d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Tambah User</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<table class="table table-striped table-hover shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Peran</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
     @foreach ($users as $id_user)
    <tr>
        <td>{{ $id_user->nama_user }}</td>
        <td>{{ $id_user->email }}</td>
        <td>{{ $id_user->role }}</td>
        <td class="d-flex justify-content-center gap-2">
            <a href="{{ route('edit_user', ['id_user' => $id_user->id_user]) }}" class="btn btn-info btn-sm" title="Edit User">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('delete_user', ['id_user' => $id_user->id_user]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Hapus User">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
