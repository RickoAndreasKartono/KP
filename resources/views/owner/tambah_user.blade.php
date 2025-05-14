@extends('layouts.owner')

@section('title', 'Tambah User - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <h2>Tambah User</h2>
  <div class="controls">
    <button class="cancel-btn" onclick="window.location.href='{{ route('kelola_user') }}'">Cancel</button>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <form action="{{ route('store_user') }}" method="POST">
    @csrf
    <!-- Input Nama -->
    <div class="form-group">
      <label for="name">Nama</label>
      <input type="name" id="name" name="name" placeholder="Masukkan Nama" required>
    </div>
    <!-- Input Email -->
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
    </div>
    
    <!-- Input Password -->
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
    </div>
    
    <!-- Role Select -->
    <div class="form-group">
      <label for="role">Peran</label>
      <select id="role" name="role" required>
        <option value="Admin">Manager</option>
        <option value="Owner">Kepala Admin</option>
        <option value="Staff">Kepala Gudang</option>
      </select>
    </div>

    <div class="form-actions">
      <button type="submit" class="done-btn">Done</button>
    </div>
  </form>
</div>  
@endsection

@push('styles')
<style>
  /* Styling Umum */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'M PLUS 1p', sans-serif;
    background-color: #f7f7f7;
    padding: 20px;
    color: #333;
  }

  .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .section-header h2 {
    font-size: 30px;
    color: black;
    font-weight: bold;
  }

  .controls {
    display: flex;
    gap: 10px;
  }

  .cancel-btn, .done-btn {
    padding: 8px 16px;
    background-color: #4caf50;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    border: 2px solid #4caf50;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .cancel-btn:hover, .done-btn:hover {
    background-color: #45a049;
    transform: scale(1.05);
  }

  .container {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-group label {
    font-size: 16px;
    font-weight: bold;
    color: #555;
  }

  .form-group input,
  .form-group select {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
    color: #555;
  }

  .form-group input:focus
