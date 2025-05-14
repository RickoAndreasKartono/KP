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
          <a href="{{ route('edit_user', ['id' => $user->id_user]) }}">
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
