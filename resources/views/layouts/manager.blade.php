<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - CV Agro Citra Indonesia</title>

    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Global styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'M PLUS 1p', sans-serif;
            background-color: #b9d8d6;
            padding: 20px;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px 30px;
            background-color: #2f5656;
            width: calc(100% + 40px); /* Adjust width to account for body padding */
            margin-left: -20px; /* Offset for body padding */
            margin-right: -20px; /* Offset for body padding */
            margin-top: -20px; /* Offset for body padding */
        }

        /* PERBAIKAN DI SINI UNTUK HEADER: */
        header a { /* Mengubah gaya link header agar flex untuk nama user */
            display: flex;
            align-items: center;
            gap: 15px; /* Jarak antara avatar dan info user */
            color: white; /* Warna teks info user */
            text-decoration: none;
        }
        .user-avatar {
            position: relative;
            width: 70px;
            height: 70px;
            background-color: #D9D9D9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-info-display { /* Container untuk nama dan role user */
            display: flex;
            flex-direction: column;
            text-align: left; /* Rata kiri teks */
        }
        .user-info-display span {
            font-family: 'M PLUS 1p', sans-serif;
            white-space: nowrap; /* Mencegah teks putus baris */
        }
        .user-info-display .user-name-display { /* Nama user */
            font-weight: bold;
            font-size: 20px;
        }
        .user-info-display .user-role-display { /* Role user */
            font-size: 14px;
            opacity: 0.8; /* Sedikit transparan untuk role */
        }
        /* AKHIR PERBAIKAN HEADER */

        header h1 { /* Ini adalah judul "CV Agro Citra Indonesia" */
            font-family: 'Potta One', cursive;
            color: #fff;
            font-size: 30px;
        }
        
        /* [BARU] Styling untuk sisi kanan header */
        .header-right {
            display: flex;
            align-items: center;
            gap: 30px; /* Jarak antara judul dan tombol logout */
        }

        /* [BARU] Styling untuk Tombol Logout di Header */
        .btn-logout-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background-color: transparent;
            color: white;
            border: 2px solid #b9d8d6; /* Warna border sama dengan background body */
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-logout-header:hover {
            background-color: #f44336; /* Warna merah saat hover untuk menandakan aksi keluar */
            border-color: #f44336;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-logout-header i {
            font-size: 18px;
        }


        .navbar {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .navbar button {
            padding: 10px 20px;
            border: 2px solid black;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-weight: bold;
            font-size: 18px;
            color: #2f5656;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .navbar button.active {
            background-color: #EEE89E;
        }

        .navbar button:hover {
            background-color: rgb(166, 227, 218);
            transform: translateY(-3px);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }

        /* This .controls might be redundant if controls-right is used, but keeping it for now */
        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .add-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            background-color: #4caf50;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            white-space: nowrap; /* Prevent wrap */
            border: 2px solid black;
            text-decoration: none; /* Ensure it looks like a button not a link */
        }

        .add-btn:hover {
            background-color: rgb(68, 154, 185);
            text-decoration: none;
        }

        .search-bar input {
            background-color: #909090;
            padding: 8px 12px;
            border: 2px solid white;
            border-radius: 8px;
            outline: none;
            font-size: 18px;
            color: white;
            width: 400px; /* Adjust width */
        }

        .search-bar input::placeholder {
            color: white;
        }

        .container {
            background-color: #d1e9e7;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            text-align: center;
            font-size: 18px;
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #3d6160;
            color: white;
        }

        /* Existing action-btn styles - keep them */
        .action-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 30px;
            color: #2f5656;
            margin: 0 5px;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.2);
        }

        .edit-btn {
            color: #4caf50;
        }

        .edit-btn:hover {
            color: rgb(1, 179, 255);
        }

        .delete-btn {
            color: #f44336;
        }

        .delete-btn:hover {
            color: rgb(189, 36, 189);
        }

        /* Modified .section-header to match specific use case (justify-content: space-between) */
        .section-header {
            display: flex;
            justify-content: space-between; /* Memisahkan elemen di kiri dan kanan */
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .controls-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* --- START ADDITIONS FOR TABLE ROLES AND ACTIONS (from previous suggestions) --- */

        /* Styling untuk form kontrol select (dropdown) dalam tabel */
        table td select {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px; /* Menyesuaikan ukuran font */
            color: #2f5656;
            background-color: #f0f0f0; /* Memberi sedikit warna latar belakang */
            -webkit-appearance: none; /* Menghilangkan gaya default browser untuk select */
            -moz-appearance: none;
            appearance: none;
            /* Tambahkan ikon dropdown kustom menggunakan SVG data URI */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%232f5656'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
            cursor: pointer;
        }

        table td select:focus {
            border-color: #2f5656;
            outline: none;
        }

        /* Styling dasar untuk tombol aksi di dalam tabel */
        table td .btn-table-action {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 24px; /* Menyesuaikan ukuran ikon agar konsisten */
            margin: 0 5px; /* Sesuaikan margin jika diperlukan */
            transition: color 0.3s ease, transform 0.2s ease;
            padding: 0; /* Menghilangkan padding default tombol */
            display: inline-flex; /* Memastikan ikon di tengah secara vertikal */
            align-items: center;
            justify-content: center;
        }

        table td .btn-table-action:hover {
            transform: scale(1.1); /* Efek zoom saat hover */
        }

        /* Styling spesifik untuk tombol update role */
        table td .btn-update-role {
            color: #4caf50; /* Warna hijau */
        }

        table td .btn-update-role:hover {
            color: #388e3c; /* Warna hijau lebih gelap saat hover */
        }

        /* Styling spesifik untuk tombol delete user */
        table td .btn-delete-user {
            color: #f44336; /* Warna merah */
        }

        table td .btn-delete-user:hover {
            color: #d32f2f; /* Warna merah lebih gelap saat hover */
        }

        /* Untuk form update role, pastikan elemen sejajar dan terpusat */
        table td form.update-role-form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        /* Penyesuaian lebar kolom untuk Role dan Aksi */
        table th:nth-child(4),
        table td:nth-child(4) {
            width: 200px;
            white-space: nowrap;
        }

        table th:last-child,
        table td:last-child {
            width: 100px;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <header>
        {{-- Sisi Kiri: Info Pengguna --}}
        <a href="{{ route('manager.profile_settings') }}">
            <div class="user-avatar">
                <img src="{{ asset('images/user.png') }}" alt="User Avatar">
            </div>
            <div class="user-info-display">
                <span class="user-name-display">{{ Auth::user()->nama_user ?? 'Guest' }}</span>
                <span class="user-role-display">({{ Auth::user()->role ?? 'Role' }})</span>
            </div>
        </a>
    
        {{-- Sisi Kanan: Judul dan Tombol Logout --}}
        <div class="header-right">
            <h1>CV Agro Citra Indonesia</h1>
    
            {{-- Tombol Logout Baru --}}
            <a href="{{ route('logout') }}" 
               class="btn-logout-header" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
    
            {{-- Form tersembunyi untuk proses logout yang aman --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>

  <!-- Navbar -->
  <div class="navbar">
    <a href="{{ route('manager.stok_pupuk') }}">
        <button class="nav-btn {{ request()->is('manager/stok_pupuk') ? 'active' : '' }}">stok pupuk</button>
    </a>
    <a href="{{ route('manager.stok_masuk') }}">
        <button class="nav-btn {{ request()->is('manager/stok_masuk') ? 'active' : '' }}">stok masuk</button>
    </a>
    <a href="{{ route('manager.stok_keluar') }}">
        <button class="nav-btn {{ request()->is('manager/stok_keluar') ? 'active' : '' }}">stok keluar</button>
    </a>
    <a href="{{ route('manager.laporan_stok') }}">
        <button class="nav-btn {{ request()->is('manager/laporan_stok') ? 'active' : '' }}">laporan stok</button>
    </a>
    <a href="{{ route('manager.manajemen_pembelian') }}">
        <button class="nav-btn {{ request()->is('manager/manajemen_pembelian') ? 'active' : '' }}">manajemen pembelian</button>
    </a>
    <a href="{{ route('manager.validasi_transaksi.index') }}">
        <button class="nav-btn {{ request()->is('manager/validasi_transaksi.index') ? 'active' : '' }}">validasi transaksi</button>
    </a>
  
</div>



   <!-- Section Header -->
  @yield('section-header')

  <!-- Content -->
  <div class="container">
    @yield('content')
  </div>

</body>
</html>
