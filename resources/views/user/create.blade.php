@extends('layouts.main')

@section('content')
    <h1>Buat User Baru</h1>

    <form action="{{ route('kelola_user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_user">Nama User:</label>
            <input type="text" name="nama_user" id="nama_user" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
 
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="kepala_admin">Kepala Admin</option>
                <option value="kepala_gudang">Kepala Gudang</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Buat User</button>
    </form>
@endsection
