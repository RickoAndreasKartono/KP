@extends('layouts.owner')

@section('title', 'Tambah Pemasok - Kepala Admin')

@section('section-header')
<div class="section-header">
  <h2>Tambah User</h2>
  <div class="controls-right">
    <a href="{{ route('kepala_admin.pemasok') }}" class="btn btn-secondary">
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

  <form method="POST" action="{{ route('kepala_admin.pemasok.add') }}">
    @csrf
        <div class="row mb-3">
            <label for="nama_pemasok" class="col-md-2 col-form-label">Nama Pemasok</label>
            <div class="col-md-10">
                <input type="text" name="nama_pemasok" id="nama_pemasok" class="form-control" placeholder="Nama Pemasok" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
            <div class="col-md-10">
                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="telepon" class="col-md-2 col-form-label">No. Telepon</label>
            <div class="col-md-10">
                <input type="text" name="telepon" id="telepon" class="form-control" placeholder="No. Telepon" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-2">
                <button type="submit" class="btn btn-success">Tambah Pemasok</button>
            </div>
        </div>
    </form>
  

    <div class="row">
      <div class="col-md-10 offset-md-2">
        <button type="submit" class="btn btn-success">Tambah Pemasok</button>
      </div>
    </div>
  </form>
</div>
@endsection
