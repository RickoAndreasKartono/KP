@extends('layouts.main')

@section('title', 'Kelola User')

@section('content')
<div class="container">
    <h2>Kelola Pengguna</h2>
    <form method="POST" action="{{ route('kelola-user') }}">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="owner">Owner</option>
            <option value="manager">Manager</option>
            <option value="kepala_admin">Kepala Admin</option>
            <option value="kepala_gudang">Kepala Gudang</option>
        </select>
        
        <button type="submit">Tambah Pengguna</button>
    </form>
</div>
@endsection
<div class="container">
    <h2>Kelola Pengguna</h2>
    <form method="POST" action="{{ route('kelola-user') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="kepala_admin">Kepala Admin</option>
                <option value="kepala_gudang">Kepala Gudang</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
    </form>
</div>