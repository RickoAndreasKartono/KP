@extends('layouts.owner')

@section('title', 'Edit User - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <h2>Edit User</h2>
  <div class="controls">
    <a href="{{ route('kelola_user') }}">
      <button class="cancel-btn">Cancel</button>
    </a>
    <button class="done-btn" type="submit">Done</button>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <form action="{{ route('update_user', $user->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Untuk mengindikasikan bahwa ini adalah request PUT -->

    <!-- Nama Pengguna -->
    <div class="form-group">
      <label for="username">Nama Pengguna</label>
      <input type="text" id="username" name="username" value="{{ old('username', $user->name) }}" placeholder="Masukkan Nama Pengguna" required>
    </div>

    <!-- Email -->
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email" required>
    </div>

    <!-- Peran -->
    <div class="form-group">
      <label for="role">Peran</label>
      <select id="role" name="role" required>
        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
        <option value="Owner" {{ $user->role == 'Owner' ? 'selected' : '' }}>Owner</option>
        <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
      </select>
    </div>

    <!-- Status Akun -->
    <div class="form-group">
      <label for="status">Status Akun</label>
      <select id="status" name="status" required>
        <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="Non-Aktif" {{ $user->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
      </select>
    </div>

    <div class="form-actions">
      <button type="submit" class="done-btn">Done</button>
    </div>
  </form>
</div>
@endsection