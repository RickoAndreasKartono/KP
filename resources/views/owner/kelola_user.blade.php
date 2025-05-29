@extends('layouts.owner')

<<<<<<< HEAD
@section('title', 'Kelola User - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <div class="header-left">
    <h2>Kelola User</h2>
    <!-- Search Form -->
    <form action="{{ route('kelola_user') }}" method="GET" class="search-form">
      <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Cari Nama atau Email" class="search-input">
      <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
    </form>
  </div>
  
  <!-- Add User Button -->
  <div class="header-right">
    <a href="{{ route('tambah_user') }}">
      <div class="add-btn action-btn">
        <i class="fas fa-plus"></i> Tambah User
      </div>
    </a>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <!-- Menampilkan pesan sukses jika ada -->
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Peran</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $id_user)
        <tr>
          <td>{{ $id_user->nama_user }}</td>
          <td>{{ $id_user->email }}</td>
          <td>{{ $id_user->role }}</td>
          <td>
            <!-- Tombol Edit -->
            <a href="{{ route('edit_user', ['id_user' => $id_user->id_user]) }}" class="action-btn edit-btn">
              <i class="fas fa-edit"></i>
            </a>

            <!-- Tombol Delete -->
            <form action="{{ route('delete_user', ['id_user' => $id_user->id_user]) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="action-btn delete-btn">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@push('styles')
<style>
/* Section header adjustments */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  width: 100%;
}

/* Header left section (Kelola User and Search) */
.header-left {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-grow: 1; /* Ensures this section takes available space */
}

.header-left h2 {
  font-size: 24px;
  font-weight: 600;
}

.search-form {
  display: flex;
  gap: 10px;
}

.search-input {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.search-btn {
  padding: 10px 15px;
  font-size: 16px;
  background-color: #007BFF;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.search-btn:hover {
  background-color: #0056b3;
}

/* Header right section (Tambah User) */
.header-right {
  display: flex;
  justify-content: flex-end;
}

.add-btn {
  padding: 10px 15px;
  background-color: #28a745;
  color: white;
  border-radius: 4px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.add-btn:hover {
  background-color: #218838;
}

/* Styling for Action Buttons */
.action-btn {
  padding: 5px 10px;
  border: none;
  cursor: pointer;
}

.edit-btn {
  background-color: #4CAF50;  /* Green */
  color: white;
}

.delete-btn {
  background-color: #f44336;  /* Red */
  color: white;
}

.action-btn:hover {
  opacity: 0.8;
}
</style>
@endpush
=======
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
>>>>>>> 2f4d4d1fa6f50e5a6d349fa1752a3f5573d7e9f7
