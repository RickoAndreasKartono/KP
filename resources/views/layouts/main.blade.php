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

  <!-- Custom CSS -->
  
  <style>
    
    /* Reset CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'M PLUS 1p', sans-serif;
      background-color: #f7f7f7;
      color: #333;
      line-height: 1.6;
    }

    /* Header */
    header {
      background-color: #00796b;
      color: white;
      display: flex;
      align-items: center;
      padding: 10px 20px;
    }

    header h1 {
      font-family: 'Potta One', cursive;
      font-size: 24px;
      margin-left: 15px;
    }

    .user-avatar img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 2px solid white;
    }

    /* Navbar */
    .navbar {
      display: flex;
      background-color: #004d40;
      padding: 10px;
      overflow-x: auto;
    }

    .navbar button {
      background-color: #00695c;
      color: white;
      border: none;
      margin-right: 10px;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .navbar button:hover {
      background-color: #004d40;
    }

    .navbar .active {
      background-color: #00acc1;
    }

    /* Main Content */
    main {
      padding: 20px;
    }

    h2 {
      font-size: 24px;
      margin-bottom: 15px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      text-align: left;
      padding: 10px;
      border: 1px solid #ddd;
    }

    table th {
      background-color: #004d40;
      color: white;
    }

    table td img {
      max-width: 100px;
      height: auto;
      border-radius: 5px;
    }

    /* Action Buttons */
    .action-btn {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .action-btn.edit-btn {
      background-color: #0277bd;
      color: white;
    }

    .action-btn.edit-btn:hover {
      background-color: #01579b;
    }

    .action-btn.delete-btn {
      background-color: #d32f2f;
      color: white;
    }

    .action-btn.delete-btn:hover {
      background-color: #b71c1c;
    }

    /* Container Styling */
    .container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      header h1 {
        font-size: 18px;
      }

      .navbar button {
        font-size: 14px;
        padding: 8px 15px;
      }

      table th, table td {
        font-size: 14px;
      }
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
    <a href="{{ url('stok_pupuk') }}"><button class="{{ request()->is('owner.stok_pupuk') ? 'active' : '' }}">stok pupuk</button></a>
    <a href="{{ url('stok_masuk') }}"><button class="{{ request()->is('stok_masuk') ? 'active' : '' }}">stok masuk</button></a>
    <a href="{{ url('stok_keluar') }}"><button class="{{ request()->is('stok_keluar') ? 'active' : '' }}">stok keluar</button></a>
    <a href="{{ url('laporan-stok') }}"><button class="{{ request()->is('laporan-stok') ? 'active' : '' }}">laporan stok</button></a>
    <a href="{{ url('manajemen_pembelian') }}"><button class="{{ request()->is('manajemen_pembelian') ? 'active' : '' }}">manajemen pembelian</button></a>
    <a href="{{ url('validasi-transaksi') }}"><button class="{{ request()->is('validasi-transaksi') ? 'active' : '' }}">validasi transaksi</button></a>
    <a href="{{ url('kelola-user') }}"><button class="{{ request()->is('kelola-user') ? 'active' : '' }}">kelola user</button></a>
  </div>

  <main>
    @yield('content')
  </main>

 
</body>
</html>
