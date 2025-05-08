@extends('layouts.main')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('kelola_user.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_user">Nama User:</label>
            <input type="text" name="nama_user" id="nama_user" class="form-control" value="{{ $user->nama_user }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin mengubah):</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="kepala_admin" {{ $user->role == 'kepala_admin' ? 'selected' : '' }}>Kepala Admin</option>
                <option value="kepala_gudang" {{ $user->role == 'kepala_gudang' ? 'selected' : '' }}>Kepala Gudang</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update User</button>
    </form>
@endsection
