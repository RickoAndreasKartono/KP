@extends('layouts.owner')

@section('title', 'Edit User - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <h2>Edit User</h2>
  <div class="controls">
    <a href="{{ route('kelola_user') }}">
      <button class="cancel-btn">Cancel</button>
    </a>
  </div>
</div>
@endsection

@section('content')
@php
  $editing_self = auth()->user()->id_user == $user->id_user && auth()->user()->role == 'owner';
@endphp

<div class="container">
  @if($editing_self)
    <div class="alert alert-warning" role="alert">
      Anda tidak dapat mengedit data Anda sendiri sebagai Owner.
    </div>
  @endif
  
  @if($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
  <form action="{{ route('update_user', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Email -->
    <div class="form-group mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" disabled>
    </div>

    <!-- Peran -->
    <div class="form-group mb-3">
      <label for="role" class="form-label">Peran</label>
      <select id="role" name="role" class="form-select" required {{ $editing_self ? 'disabled' : '' }}>
        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
        <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
      </select>
      @if ($editing_self)
        <input type="hidden" name="role" value="{{ $user->role }}">
      @endif
    </div>

    <div class="form-actions d-flex justify-content-end">
      <button type="submit" class="btn btn-primary" {{ $editing_self ? 'disabled' : '' }}>Done</button>
    </div>
  </form>
</div>
@endsection

@push('styles')
<style>
  .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
  }

  .section-header h2 {
    font-size: 24px;
    font-weight: 600;
    color: #2f5656;
  }

  .form-group label {
    font-size: 16px;
    font-weight: 600;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    background-color: #f9f9f9;
  }

  .form-group input:focus,
  .form-group select:focus {
    outline: none;
    border-color: #007BFF;
  }

  .form-actions button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }

  .form-actions button:hover {
    background-color: #0056b3;
  }

.cancel-btn {
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    background-color: #4CAF50; /* Warna hijau */
    color: white;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.cancel-btn:hover {
    background-color: #45a049; /* Hijau lebih gelap saat di-hover */
}

  /* Alert Styling */
  .alert {
    font-size: 16px;
    margin-bottom: 20px;
  }
</style>
@endpush
