@extends('layouts.owner')

@section('title', 'Kelola User - CV Agro Citra Indonesia')

@section('section-header')
<div class="section-header">
  <h2>Kelola User</h2>
  <div class="controls">
    <a href="{{ route('tambah_user') }}">
      <div class="add-btn">
        <i class="fas fa-plus"></i> Tambah User
      </div>
    </a>
    <div class="search-bar">
      <input type="text" placeholder="Cari user..." id="searchUser">
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Peran</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="userTableBody">
      <tr>
        <td>John Doe</td>
        <td>johndoe@example.com</td>
        <td>Admin</td>
        <td>
          <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
          <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
      <tr>
        <td>Jane Smith</td>
        <td>janesmith@example.com</td>
        <td>Owner</td>
        <td>
          <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
          <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection

