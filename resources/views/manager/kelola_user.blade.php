@extends('layouts.owner')

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
      <div class="add-btn">
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
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->nama_user }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
          <a href="{{ route('edit_user', ['id_user' => $user->id_user]) }}">
            <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
          </a>
          <button class="action-btn delete-btn" title="Hapus" onclick="confirmDelete({{ $user->id_user }})"><i class="fas fa-trash"></i></button>
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
