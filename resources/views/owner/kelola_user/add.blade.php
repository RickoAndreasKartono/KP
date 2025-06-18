@extends('layouts.add')

@section('title', 'Tambah User - Owner')

@section('section-header')



@section('content')
<div class="form-container">
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Terjadi kesalahan:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('owner.kelola_user.add') }}" id="addUserForm">
    @csrf
    
    <div class="form-group">
      <label for="nama">
        <i class="fas fa-user"></i> Nama Lengkap
      </label>
      <input 
        type="text" 
        name="nama" 
        id="nama" 
        class="form-control" 
        placeholder="Masukkan nama lengkap pengguna"
        value="{{ old('nama') }}"
        required
      >
    </div>

    <div class="form-group">
      <label for="email">
        <i class="fas fa-envelope"></i> Email
      </label>
      <input 
        type="email" 
        name="email" 
        id="email" 
        class="form-control" 
        placeholder="contoh@email.com"
        value="{{ old('email') }}"
        required
      >
    </div>

    <div class="form-group">
      <label for="password">
        <i class="fas fa-lock"></i> Password
      </label>
      <div class="password-toggle">
        <input 
          type="password" 
          name="password" 
          id="password" 
          class="form-control" 
          placeholder="Masukkan password (minimal 8 karakter)"
          required
          minlength="8"
        >
        <button
          type="button" 
          class="password-toggle-btn" 
          onclick="togglePassword(this)"
          title="Tampilkan/Sembunyikan Password"
        >
          <i class="fas fa-eye" id="password-eye"></i>
        </button>
      </div>
    </div>

    <div class="form-group">
      <label for="role">
        <i class="fas fa-user-tag"></i> Role/Jabatan
      </label>
      <select name="role" id="role" class="form-select" required>
        <option value="">Pilih Role</option>
        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="kepala_admin" {{ old('role') == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
        <option value="kepala_gudang" {{ old('role') == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
      </select>
    </div>

    <div class="form-footer">
      <button type="submit" class="submit-btn">
        <i class="fas fa-user-plus"></i>
        Tambah User
      </button>
    </div>
  </form>
</div>
@endsection