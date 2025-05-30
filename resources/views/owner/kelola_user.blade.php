@extends('layouts.owner')

@section('title', 'Kelola User - CV Agro Citra Indonesia')

@section('content')
  <!-- Header untuk Kelola User, Search, dan Tambah User -->
  <div class="section-header">
    <div class="header-left">
      <h2>Kelola User</h2>
      <!-- Search Form langsung sebelah -->
      <form action="{{ route('kelola_user') }}" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Cari Nama atau Email" class="search-input">
        <button type="submit" class="search-btn">Cari</button>
      </form>
    </div>
    
    <!-- Tombol Tambah User -->
    <div class="header-right">
      <a href="{{ route('tambah_user') }}" class="add-btn">
        <i class="fas fa-plus"></i> Tambah User
      </a>
    </div>
  </div>

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
  gap: 20px;  /* Add gap between elements */
}

/* Header left section (Kelola User + Search) */
.header-left {
  display: flex;
  align-items: center;
  gap: 15px;  /* Space between Kelola User and search input */
  flex-wrap: nowrap; /* Prevent wrapping to the next line */
}

/* Kelola User title */
.header-left h2 {
  font-size: 28px;
  font-weight: 700;
  margin: 0;
  color: #333;
}

/* Search Form Styling */
.search-form {
  display: flex;
  gap: 10px;  /* Add space between the input and button */
  align-items: center;
}

.search-input {
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 200px;  /* Adjust width for better proportion */
  font-size: 14px;
}

.search-btn {
  padding: 8px 15px;
  background: #6c757d;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.search-btn:hover {
  background: #5a6268;
}

/* Header right section (Tambah User button) */
.header-right {
  display: flex;
  align-items: center;
}

/* Add User Button styling */
.add-btn {
  padding: 12px 20px;
  background: linear-gradient(135deg, #28a745, #20c997);
  color: white;
  border-radius: 25px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
  border: none;
}

.add-btn:hover {
  background: linear-gradient(135deg, #218838, #1ea98a);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

/* Table styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

table thead {
  background-color: #5a6c5d;
  color: white;
}

table th,
table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

table tbody tr:hover {
  background-color: #f5f5f5;
}

/* Styling for Action Buttons */
.action-btn {
  padding: 5px 10px;
  border: none;
  cursor: pointer;
  border-radius: 3px;
  margin-right: 5px;
  transition: opacity 0.3s;
}

.edit-btn {
  background-color: #4CAF50;
  color: white;
}

.delete-btn {
  background-color: #f44336;
  color: white;
}

.action-btn:hover {
  opacity: 0.8;
}

/* Alert styling */
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 4px;
}

.alert-success {
  background-color: #d4edda;
  border-color: #c3e6cb;
  color: #155724;
}

/* Container styling */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}
</style>
@endpush
