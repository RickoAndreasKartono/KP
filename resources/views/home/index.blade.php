@extends('layouts.app')

@section('content')
<div class="content">
    <h3>Data Stok Pupuk</h3>

    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> add
        </button>

        <input type="text" class="form-control w-25" placeholder="search...">
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Nama Pupuk</th>
                <th>Jumlah Tersedia</th>
                <th>Lokasi Simpan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img src="https://i.ibb.co/RCz3SzX/urea.png" alt="Pupuk Urea"><br>
                    Pupuk urea (N)
                </td>
                <td>20</td>
                <td>....</td>
                <td class="aksi-button">
                    <button class="btn btn-light"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="https://i.ibb.co/RCz3SzX/urea.png" alt="Pupuk Urea"><br>
                    Pupuk urea (N)
                </td>
                <td>20</td>
                <td>....</td>
                <td class="aksi-button">
                    <button class="btn btn-light"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
