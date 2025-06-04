@extends('layouts.kepala_admin') <!-- Sesuaikan dengan layout utama kamu -->

@section('title', 'Data Pemasok - Kepala Admin')

@section('section-header')
<div class="section-header">
  <h2>Data Pemasok</h2>
  <div class="controls-right">
    <a href="{{ route('pemasok.add') }}" class="add-btn">
      <i class="fas fa-plus"></i> Tambah
    </a>
    <form method="GET" action="{{ route('pemasok') }}" class="search-bar">
      <input type="text" name="search" placeholder="Cari ID, Nama..." value="{{ request('search') }}">
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
        <th>ID User</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Password (Hashed)</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <td>{{ $user->id_user }}</td>
        <td>{{ $user->nama }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <form method="POST" action="{{ route('kelola_user.update_role', $user->id_user) }}" class="d-flex align-items-center">
            @csrf
            <select name="role" class="form-control form-control-sm me-1">
              <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
              <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
              <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
            </select>
            <button type="submit" class="btn btn-sm btn-success" title="Update Role">
              <i class="fas fa-check-circle"></i>
            </button>
          </form>
        </td>
        <td>{{ $user->password }}</td>
        <td>
          <form method="POST" action="{{ route('kelola_user.delete', $user->id_user) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Hapus User">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6">Belum ada data user.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
