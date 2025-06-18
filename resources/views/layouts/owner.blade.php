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
            width: calc(100% + 40px);
            margin-left: -20px;
            margin-right: -20px;
            margin-top: -20px;
        }

        /* PERBAIKAN DI SINI UNTUK HEADER: */
        header a {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
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
        .user-info-display {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .user-info-display span {
            font-family: 'M PLUS 1p', sans-serif;
            white-space: nowrap;
        }
        .user-info-display .user-name-display {
            font-weight: bold;
            font-size: 20px;
        }
        .user-info-display .user-role-display {
            font-size: 14px;
            opacity: 0.8;
        }
        /* AKHIR PERBAIKAN HEADER */

        header h1 {
            font-family: 'Potta One', cursive;
            color: #fff;
            font-size: 30px;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .btn-logout-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background-color: transparent;
            color: white;
            border: 2px solid #b9d8d6;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-logout-header:hover {
            background-color: #f44336;
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

        /* PERBAIKAN: Styling untuk bagian kiri section header */
        .section-header-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .controls-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .add-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 15px;
            height: 43px;
            background-color: #4caf50;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            white-space: nowrap;
            border: none;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .add-btn:hover {
            background-color: #45a049;
            text-decoration: none;
        }
        
        /* === STYLING SEARCH BAR YANG DIPERBAIKI === */
        .search-bar {
            display: flex;
            align-items: center;
            border: 2px solid #2f5656;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            height: 43px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px; /* Fixed width untuk search bar */
        }

        .search-bar input[type="text"] {
            border: none;
            outline: none;
            padding: 10px 15px;
            font-size: 16px;
            color: #333;
            width: 100%;
            background-color: transparent;
            transition: all 0.2s ease-in-out;
            flex: 1; /* Menggunakan flex untuk mengisi ruang yang tersedia */
        }

        .search-bar input[type="text"]::placeholder {
            color: #888;
        }

        .search-bar:focus-within input[type="text"] {
            /* Tidak mengubah width, hanya mengubah style focus */
            background-color: #f8f9fa;
        }

        .search-bar button {
            background-color: #2f5656;
            border: none;
            padding: 0 15px;
            height: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .search-bar button i {
            color: white;
            font-size: 16px;
        }

        .search-bar button:hover {
            background-color: #3d6160;
        }

        .search-bar:focus-within {
            border-color: #4caf50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        /* === AKHIR STYLING SEARCH BAR === */

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
        
        /* --- STYLING UNTUK ELEMEN DALAM TABEL --- */
        table td select {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #2f5656;
            background-color: #f0f0f0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
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
        table td .btn-table-action {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 24px;
            margin: 0 5px;
            transition: color 0.3s ease, transform 0.2s ease;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        table td .btn-table-action:hover {
            transform: scale(1.1);
        }
        table td .btn-delete-user {
            color: #f44336;
        }
        table td .btn-delete-user:hover {
            color: #d32f2f;
        }
        table td form.update-role-form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
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

        /* PERBAIKAN: Alert styling */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .section-header-left {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
                width: 100%;
            }
            
            .controls-right {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
                width: 100%;
            }
            
            .search-bar {
                width: 100%;
                max-width: 350px;
            }
        }

        @media (max-width: 480px) {
            .section-header-left {
                gap: 10px;
            }
            
            .search-bar {
                width: 100%;
                max-width: 280px;
            }
        }
    </style>
</head>
<body>
    <header>
        {{-- Sisi Kiri: Info Pengguna --}}
        <a href="#">
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

    <div class="navbar">
        <a href="{{ route('owner.stok_pupuk') }}">
            <button class="nav-btn {{ request()->is('owner/stok_pupuk') ? 'active' : '' }}">stok pupuk</button>
        </a>
        <a href="{{ route('owner.stok_masuk') }}">
            <button class="nav-btn {{ request()->is('owner/stok_masuk') ? 'active' : '' }}">stok masuk</button>
        </a>
        <a href="{{ route('owner.stok_keluar') }}">
            <button class="nav-btn {{ request()->is('owner/stok_keluar') ? 'active' : '' }}">stok keluar</button>
        </a>
        <a href="{{ route('owner.laporan_stok') }}">
            <button class="nav-btn {{ request()->is('owner/laporan_stok') ? 'active' : '' }}">laporan stok</button>
        </a>
        <a href="{{ route('owner.manajemen_pembelian') }}">
            <button class="nav-btn {{ request()->is('owner/manajemen_pembelian') ? 'active' : '' }}">manajemen pembelian</button>
        </a>
        <a href="{{ route('owner.validasi_transaksi') }}">
            <button class="nav-btn {{ request()->is('owner/validasi_transaksi') ? 'active' : '' }}">validasi transaksi</button>
        </a>
        <a href="{{ route('owner.kelola_user') }}">
            <button class="nav-btn {{ request()->is('owner/kelola_user') ? 'active' : '' }}">kelola user</button>
        </a>
    </div>

    @yield('section-header')
    
    @yield('content')

</body>
</html>