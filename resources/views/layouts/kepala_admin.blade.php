<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - CV Agro Citra Indonesia</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Global styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        header h1 {
            font-family: 'Potta One', cursive;
            color: #fff;
            font-size: 30px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
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

        .user-role {
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .logout-btn {
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            border: 2px solid black;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
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

        /* Section Header Styling */
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

        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Add Button Styling */
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
            white-space: nowrap;
            border: 2px solid black;
        }

        .add-btn:hover {
            background-color: rgb(68, 154, 185);
        }

        /* Search Bar Styling */
        .search-bar input {
            background-color: #909090;
            padding: 8px 12px;
            border: 2px solid white;
            border-radius: 8px;
            outline: none;
            font-size: 18px;
            color: white;
            width: 400px;
        }

        .search-bar input::placeholder {
            color: white;
        }

        /* Container Styling */
        .container {
            background-color: #d1e9e7;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
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
  </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="user-info">
            <div class="user-avatar">
                <img src="{{ asset('images/user.png') }}" alt="User Avatar">
            </div>
            <div class="user-role">
                Kepala Admin
            </div>
            <button class="logout-btn" onclick="window.location.href='{{route('login') }}'">Logout</button>
        </div>
        <h1>CV Agro Citra Indonesia</h1>
    </header>

    <!-- Navbar -->
<div class="navbar">
  <a href="{{ url('kepala_admin.stok_pupuk') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/stok_pupuk') ? 'active' : '' }}">stok pupuk</button>
  </a>
  <a href="{{ url('kepala_admin.stok_masuk') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/stok_masuk') ? 'active' : '' }}">stok masuk</button>
  </a>
  <a href="{{ url('kepala_admin.stok_keluar') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/stok_keluar') ? 'active' : '' }}">stok keluar</button>
  </a>
  <a href="{{ url('kepala_admin.laporan_stok') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/laporan_stok') ? 'active' : '' }}">laporan stok</button>
  </a>
  <a href="{{ url('kepala_admin.manajemen_pembelian') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/manajemen_pembelian') ? 'active' : '' }}">manajemen pembelian</button>
  </a>
  <a href="{{ url('kepala_admin.validasi_transaksi') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/validasi_transaksi') ? 'active' : '' }}">validasi transaksi</button>
  </a>
  <a href="{{ url('kepala_admin.kelola_user') }}">
    <button class="nav-btn {{ request()->is('kepala_admin/kelola_user') ? 'active' : '' }}">kelola user</button>
  </a>
</div>

  <!-- Section Header -->
  <div class="section-header">
    @yield('section-header')
  </div>

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
