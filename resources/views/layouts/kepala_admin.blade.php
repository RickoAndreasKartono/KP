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
      text-decoration: none;
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

  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="user-avatar">
      <img src="{{ asset('images/user.png') }}" alt="User Avatar">
    </div>
    <h1>CV Agro Citra Indonesia</h1>
  </header>

  <!-- Navbar -->
  <div class="navbar">
    <a href="{{ route('stok_pupuk') }}">
        <button class="nav-btn {{ request()->is('owner/stok_pupuk') ? 'active' : '' }}">stok pupuk</button>
    </a>
    <a href="{{ route('stok_masuk') }}">
        <button class="nav-btn {{ request()->is('owner/stok_masuk') ? 'active' : '' }}">stok masuk</button>
    </a>
    <a href="{{ route('stok_keluar') }}">
        <button class="nav-btn {{ request()->is('owner/stok_keluar') ? 'active' : '' }}">stok keluar</button>
    </a>
    <a href="{{ route('laporan_stok') }}">
        <button class="nav-btn {{ request()->is('owner/laporan_stok') ? 'active' : '' }}">laporan stok</button>
    </a>
    <a href="{{ route('manajemen_pembelian') }}">
        <button class="nav-btn {{ request()->is('owner/manajemen_pembelian') ? 'active' : '' }}">manajemen pembelian</button>
    </a>
    <a href="{{ route('validasi_transaksi') }}">
        <button class="nav-btn {{ request()->is('owner/validasi_transaksi') ? 'active' : '' }}">validasi transaksi</button>
    </a>
    <a href="{{ route('pemasok') }}">
        <button class="nav-btn {{ request()->is('kepala_admin/pemasok') ? 'active' : '' }}">pemasok</button>
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
