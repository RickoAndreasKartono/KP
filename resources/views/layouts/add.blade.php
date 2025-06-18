{{-- File: resources/views/layouts/add.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Form') - CV Agro Citra Indonesia</title>

    {{-- Link Font & Ikon Global --}}
    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* CSS Global (Sesuai Gaya Owner) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'M PLUS 1p', sans-serif;
            background-color: #b9d8d6;
            padding: 20px; /* Mengembalikan padding body sesuai permintaan */
        }

        /* --- Header Utama (Sesuai Gaya Owner) --- */
        .main-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            background-color: #2f5656; /* Warna solid, bukan gradien */
            color: #ffffff;
            /* Trik untuk membuat header membentang penuh trotz padding body */
            width: calc(100% + 40px);
            margin-left: -20px;
            margin-right: -20px;
            margin-top: -20px;
            margin-bottom: 20px;
        }
        .user-profile-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #ffffff;
            text-decoration: none;
        }
        .user-avatar {
            width: 60px; height: 60px; border-radius: 50%;
            border: 2px solid #ffffff; background-color: #D9D9D9;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .user-avatar img { width: 80%; height: 80%; object-fit: cover; }
        .user-info-display .user-name-display { font-weight: 700; font-size: 1.25rem; }
        .user-info-display .user-role-display { font-size: 0.9rem; opacity: 0.8; }
        .header-right { display: flex; align-items: center; gap: 2rem; }
        .company-title { font-family: 'Potta One', cursive; font-size: 2rem; }
        .btn-logout-header {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 15px; color: #ffffff;
            border: 2px solid #b9d8d6;
            border-radius: 10px; /* Bentuk rounded rectangle biasa */
            font-weight: 700; text-decoration: none; transition: all 0.3s ease;
        }
        .btn-logout-header:hover { background-color: #f44336; border-color: #f44336; }
        
        /* --- Navigasi (Sesuai Gaya Owner) --- */
        .navbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .nav-link { /* Ini adalah <a> yang digayakan seperti <button> */
            padding: 10px 20px;
            border: 2px solid black;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 700;
            font-size: 1rem; /* Ukuran font disesuaikan agar mirip */
            color: #2f5656;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: capitalize;
        }
        .nav-link:hover {
            background-color: #eaf5f4;
            transform: translateY(-2px);
        }
        .nav-link.active {
            background-color: #EEE89E; /* Warna kuning untuk status aktif */
        }
        
        /* --- CSS Spesifik untuk Halaman Form --- */
        .form-page-container {
             background-color: #d1e9e7;
             padding: 20px;
             border-radius: 12px;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-header h2 {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }
        .back-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 16px; background-color: #909090;
            color: white; border-radius: 8px; text-decoration: none;
            font-weight: bold; font-size: 16px;
            border: 2px solid #333; transition: all 0.3s ease;
        }
        .back-btn:hover { background-color: #666; transform: translateY(-2px); }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #2f5656;
        }
        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: block; font-weight: bold;
            font-size: 18px; color: #2f5656;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            width: 100%; padding: 12px 16px; font-size: 16px;
            border: 2px solid #2f5656; border-radius: 8px;
            background-color: #f8f8f8; color: #333;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            outline: none; border-color: #4caf50;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }
        .submit-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 24px; background-color: #4caf50;
            color: white; border: 2px solid #333;
            border-radius: 10px; font-weight: bold;
            font-size: 18px; cursor: pointer; text-decoration: none;
            transition: all 0.3s ease;
        }
        .submit-btn:hover { background-color: #45a049; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; border: 2px solid; }
        .alert-danger { background-color: #f8d7da; border-color: #f44336; color: #721c24; }
        
        /* Gaya untuk toggle password */
        .password-toggle { position: relative; }
        .password-toggle .form-control { padding-right: 45px; }
        .password-toggle-btn {
            position: absolute; right: 1px; top: 1px; bottom: 1px;
            width: 45px; background: transparent; border: none;
            color: #6c757d; cursor: pointer;
        }
        
        /* [FIX] Sembunyikan ikon mata bawaan browser */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-password-reveal-button {
            display: none;
            appearance: none;
        }
    </style>
</head>
<body>
    {{-- HEADER UTAMA (Menggunakan struktur dari dashboard) --}}
    <header class="main-header">
        <a href="{{-- route('owner.profile_settings') --}}" class="user-profile-link">
            <div class="user-avatar">
                <img src="{{ asset('images/user.png') }}" alt="User Avatar">
            </div>
            <div class="user-info-display">
                <span class="user-name-display">{{ Auth::user()->nama_user ?? 'Guest User' }}</span>
                <span class="user-role-display">({{ Str::ucfirst(Auth::user()->role ?? 'Role') }})</span>
            </div>
        </a>    
        <div class="header-right">
            <h1 class="company-title">CV Agro Citra Indonesia</h1>
            <a href="{{ route('logout') }}" class="btn-logout-header" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>

    {{-- KONTEN UTAMA HALAMAN --}}
    <main>
        {{-- NAVBAR (Menggunakan struktur dari dashboard) --}}
        <nav class="navbar">
            <a href="{{ route('owner.stok_pupuk') }}" class="nav-link {{ request()->is('owner/stok_pupuk*') ? 'active' : '' }}">Stok Pupuk</a>
            <a href="{{ route('owner.stok_masuk') }}" class="nav-link {{ request()->is('owner/stok_masuk*') ? 'active' : '' }}">Stok Masuk</a>
            <a href="{{ route('owner.stok_keluar') }}" class="nav-link {{ request()->is('owner/stok_keluar*') ? 'active' : '' }}">Stok Keluar</a>
            <a href="{{ route('owner.laporan_stok') }}" class="nav-link {{ request()->is('owner/laporan_stok*') ? 'active' : '' }}">Laporan Stok</a>
            <a href="{{ route('owner.manajemen_pembelian') }}" class="nav-link {{ request()->is('owner/manajemen_pembelian*') ? 'active' : '' }}">Manajemen Pembelian</a>
            <a href="{{ route('owner.validasi_transaksi') }}" class="nav-link {{ request()->is('owner/validasi_transaksi*') ? 'active' : '' }}">Validasi Transaksi</a>
            <a href="{{ route('owner.kelola_user') }}" class="nav-link {{ request()->is('owner/kelola_user*') ? 'active' : '' }}">Kelola User</a>
        </nav>

        {{-- KONTENER KHUSUS UNTUK HALAMAN FORM --}}
        <div class="form-page-container">
            @yield('content')
        </div>
    </main>

    {{-- Tempat untuk script jika dibutuhkan --}}
    @yield('scripts')

    {{-- [BARU] SCRIPT UNTUK FUNGSI TOGGLE PASSWORD --}}
    <script>
        function togglePassword(button) {
            // Temukan elemen input password yang berada tepat sebelum tombol yang diklik
            const passwordInput = button.previousElementSibling;
            // Temukan ikon (i) di dalam tombol
            const icon = button.querySelector('i');

            // Periksa tipe input saat ini
            if (passwordInput.type === 'password') {
                // Jika tipenya password, ubah menjadi text agar terlihat
                passwordInput.type = 'text';
                // Ubah ikon mata menjadi mata-coret
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                // Jika tipenya text, kembalikan menjadi password
                passwordInput.type = 'password';
                // Ubah ikon kembali menjadi mata
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
