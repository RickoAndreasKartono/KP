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
  
  <form action="{{ route('update_user', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT') <!-- Untuk mengindikasikan bahwa ini adalah request PUT -->

    <!-- Email -->
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>
    </div>

    <!-- Peran -->
    <div class="form-group">
      <label for="role">Peran</label>
      <select id="role" name="role" required {{ $editing_self ? 'disabled' : '' }}>
        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
        <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
      </select>
      @if ($editing_self)
        <input type="hidden" name="role" value="{{ $user->role }}">
      @endif
    </div>

    <div class="form-actions">
      <button type="submit" class="done-btn" {{ $editing_self ? 'disabled' : '' }}>Done</button>
    </div>
  </form>
</div>
@endsection


@push('styles')
<style>
  /* Basic layout adjustments */
.container {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
}

/* Section header */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.section-header h2 {
  font-size: 24px;
  font-weight: 600;
}

.controls {
  display: flex;
  gap: 10px;
}

.controls .cancel-btn, .controls .done-btn {
  padding: 8px 16px;
  font-size: 14px;
  border: none;
  cursor: pointer;
}

.cancel-btn {
  background-color: #f44336;
  color: white;
}

.done-btn {
  background-color: #4CAF50;
  color: white;
}

.done-btn[type="submit"] {
  background-color: #007BFF;
}

.done-btn:hover, .cancel-btn:hover {
  opacity: 0.8;
}

/* Form Group */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-size: 16px;
  margin-bottom: 5px;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus {
  outline: none;
  border-color: #007BFF;
}

/* Form actions */
.form-actions {
  margin-top: 20px;
}

.form-actions button {
  padding: 10px 20px;
  font-size: 16px;
  background-color: #007BFF;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.form-actions button:hover {
  opacity: 0.8;
}