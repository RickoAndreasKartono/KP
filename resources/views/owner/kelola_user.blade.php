@extends('layouts.owner')

@section('title', 'Kelola User')

@section('content')
<div class="container">
    <h2>Kelola Pengguna</h2>

    <!-- Add User Button -->
    <div class="controls">
        <a href="#addUserModal" data-bs-toggle="modal" class="add-btn">Tambah Pengguna</a>
    </div>

    <!-- Search User -->
    <div class="search-bar">
        <input type="text" id="search-user" placeholder="Cari pengguna..." onkeyup="filterUsers()">
    </div>

    <!-- User Table -->
    <table id="user-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->nama_user }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <!-- Edit Role Button -->
                    <a href="#editRoleModal" data-bs-toggle="modal" data-id="{{ $user->id_user }}" data-role="{{ $user->role }}" class="edit-btn action-btn">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('kelola_user.delete', $user->id_user) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn action-btn" onclick="return confirm('Hapus pengguna ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h3>Tambah Pengguna Baru</h3>
            <form method="POST" action="{{ route('kelola_user.add') }}">
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

                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <h3>Edit Role Pengguna</h3>
            <form method="POST" action="{{ route('kelola_user.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-user-id" name="id_user">

                <label for="role">Role:</label>
                <select id="edit-role" name="role" required>
                    <option value="owner">Owner</option>
                    <option value="manager">Manager</option>
                    <option value="kepala_admin">Kepala Admin</option>
                    <option value="kepala_gudang">Kepala Gudang</option>
                </select>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Search Users
    function filterUsers() {
        let input = document.getElementById('search-user').value.toLowerCase();
        let rows = document.querySelectorAll('#user-table tbody tr');

        rows.forEach(row => {
            let name = row.children[0].textContent.toLowerCase();
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }

    // Edit Role Modal
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let userId = this.dataset.id;
            let role = this.dataset.role;

            document.getElementById('edit-user-id').value = userId;
            document.getElementById('edit-role').value = role;
        });
    });
</script>
@endsection