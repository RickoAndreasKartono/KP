@extends('layouts.add')

@section('title', 'Tambah User - Owner')

@section('section-header')
<div class="section-header">
  <h2>Tambah User</h2>  
  <div class="controls-right">
    <a href="{{ route('owner.kelola_user') }}" class="back-btn">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>



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
          onclick="togglePassword()"
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
        <option value="">-- Pilih Role --</option>
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

<script>
function togglePassword() {
  const passwordInput = document.getElementById('password');
  const passwordEye = document.getElementById('password-eye');
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    passwordEye.classList.remove('fa-eye');
    passwordEye.classList.add('fa-eye-slash');
  } else {
    passwordInput.type = 'password';
    passwordEye.classList.remove('fa-eye-slash');
    passwordEye.classList.add('fa-eye');
  }
}

// Form validation
document.getElementById('addUserForm').addEventListener('submit', function(e) {
  const password = document.getElementById('password').value;
  const email = document.getElementById('email').value;
  
  // Basic password validation
  if (password.length < 8) {
    e.preventDefault();
    alert('Password harus minimal 8 karakter!');
    return;
  }
  
  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    e.preventDefault();
    alert('Format email tidak valid!');
    return;
  }
});

// Auto-focus first input
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('nama').focus();
});
</script>
@endsection