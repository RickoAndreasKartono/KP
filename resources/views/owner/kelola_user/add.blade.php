@extends('layouts.owner')

@section('title', 'Tambah User - Owner')

@section('section-header')
<div class="section-header">
  <h2>Tambah User</h2>
  <div class="controls-right">
    <a href="{{ route('kelola_user') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>
@endsection

@section('content')
<div class="container">

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('kelola_user.add') }}">
    @csrf
    <div class="row mb-3">
      <label for="nama" class="col-md-2 col-form-label">Nama</label>
      <div class="col-md-10">
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="email" class="col-md-2 col-form-label">Email</label>
      <div class="col-md-10">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="password" class="col-md-2 col-form-label">Password</label>
      <div class="col-md-10">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="role" class="col-md-2 col-form-label">Role</label>
      <div class="col-md-10">
        <select name="role" id="role" class="form-control" required>
          <option value="">Pilih Role</option>
          <option value="manager">Manager</option>
          <option value="kepala_admin">Kepala Admin</option>
          <option value="kepala_gudang">Kepala Gudang</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 offset-md-2">
        <button type="submit" class="btn btn-success">Tambah User</button>
      </div>
    </div>
  </form>
</div>
@endsection
