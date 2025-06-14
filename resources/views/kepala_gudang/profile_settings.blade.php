@extends('layouts.profile_settings')

@section('title', $getRecord->nama_user . "'s Profile")

@section('content')
    <div class="profile-card">
        
        {{-- BAGIAN HEADER PROFIL --}}
        <header class="profile-header">
            <img src="{{ asset('images/user.png') }}" alt="User Avatar" class="profile-avatar">
            <h1 class="user-name">{{ $getRecord->nama_user }}</h1>
            {{-- Role pengguna telah dipindahkan ke bawah --}}
        </header>

        {{-- BAGIAN BODY PROFIL (FORM) --}}
        <main class="profile-body">
            
            {{-- [DITAMBAHKAN] Tombol Kembali --}}
           <a href="{{ (url()->previous() != url()->full()) ? url()->previous() : route('kepala_gudang.stok_pupuk') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            <form action="{{ route('kepala_gudang.update_profile') }}" method="POST">
                @csrf
                @method('PATCH')

                <h2 class="form-title">Ubah Detail Akun</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="nama_user">Nama</label>
                    <input type="text" id="nama_user" name="nama_user" class="form-control" value="{{ old('nama_user', $getRecord->nama_user) }}">
                    @error('nama_user')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" value="{{ $getRecord->email }}" readonly>
                </div>

                {{-- [DIPINDAHKAN] Field Role (Read-Only) --}}
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" id="role" class="form-control" value="{{ $getRecord->role }}" readonly>
                </div>
                
                <div class="actions-row">
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                    <a href="{{ route('logout') }}" class="btn btn-logout">Logout</a>
                </div>
            </form>

        </main>
    </div>
@endsection