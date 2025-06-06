@extends('layouts.owner')

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

<style>
  .back-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background-color: #909090;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    border: 2px solid #333;
    transition: all 0.3s ease;
  }

  .back-btn:hover {
    background-color: #666;
    transform: translateY(-2px);
    text-decoration: none;
    color: white;
  }

  .form-container {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 2px solid #2f5656;
  }

  .form-group {
    margin-bottom: 25px;
  }

  .form-group label {
    display: block;
    font-weight: bold;
    font-size: 18px;
    color: #2f5656;
    margin-bottom: 8px;
  }

  .form-control {
    width: 100%;
    padding: 12px 16px;
    font-size: 16px;
    border: 2px solid #2f5656;
    border-radius: 8px;
    background-color: #f8f8f8;
    color: #333;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: #4caf50;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
  }

  .form-control::placeholder {
    color: #888;
  }

  .form-select {
    width: 100%;
    padding: 12px 16px;
    font-size: 16px;
    border: 2px solid #2f5656;
    border-radius: 8px;
    background-color: #f8f8f8;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .form-select:focus {
    outline: none;
    border-color: #4caf50;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
  }

  .submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 24px;
    background-color: #4caf50;
    color: white;
    border: 2px solid #333;
    border-radius: 10px;
    font-weight: bold;
    font-size: 18px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .submit-btn:hover {
    background-color: #45a049;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 2px solid;
  }

  .alert-danger {
    background-color: #f8d7da;
    border-color: #f44336;
    color: #721c24;
  }

  .alert ul {
    margin: 0;
    padding-left: 20px;
  }

  .alert li {
    margin-bottom: 5px;
    font-weight: 500;
  }

  .form-row {
    display: flex;
    gap: 20px;
    align-items: flex-end;
  }

  .form-row .form-group {
    flex: 1;
  }

  .password-toggle {
    position: relative;
  }

  .password-toggle-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    font-size: 16px;
    padding: 4px;
  }

  .password-toggle-btn:hover {
    color: #2f5656;
  }

  .form-footer {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
    text-align: right;
  }

  @media (max-width: 768px) {
    .form-row {
      flex-direction: column;
      gap: 0;
    }
    
    .form-container {
      padding: 20px;
    }
    
    .section-header {
      flex-direction: column;
      gap: 15px;
      align-items: flex-start;
    }
  }
</style>
@endsection

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