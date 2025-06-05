<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - CV Agro Citra Indonesia</title>

    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        /* Remove underlines from ALL links */
        a {
            text-decoration: none;
        }

        a:hover,
        a:focus,
        a:active,
        a:visited {
            text-decoration: none;
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
            text-decoration: none;
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
            text-decoration: none;
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
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
            text-decoration: none;
        }

        .navbar {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .navbar a {
            text-decoration: none;
        }

        .navbar a:hover,
        .navbar a:focus,
        .navbar a:active,
        .navbar a:visited {
            text-decoration: none;
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
            text-decoration: none;
        }

        .navbar button.active {
            background-color: #EEE89E;
        }

        .navbar button:hover {
            background-color: rgb(166, 227, 218);
            transform: translateY(-3px);
            text-decoration: none;
        }

        /* Section Header Styling */
        /* Removed flex properties from .section-header as it will be handled by Bootstrap classes in specific blade files */
        .section-header {
            margin-top: 20px;
            margin-bottom: 20px;
            /* Keep basic margins */
        }

        .section-header h2 {
            font-size: 30px;
            color: black;
            font-weight: bold;
            text-decoration: none;
            /* No margin-bottom here unless specifically needed for a type of header */
        }

        /* Add Button Styling (re-using the old .add-btn which was good) */
        /* Note: Your image shows btn-success with black border, which is custom.
           Let's refine the custom button styles below. */


        /* Bootstrap specific overrides for the new design */
        .form-control {
            background-color: #909090;
            border: 2px solid white;
            color: white;
            border-radius: 8px;
            font-size: 18px;
        }

        .form-control::placeholder {
            color: white;
        }

        .btn-primary {
            background-color: #2f5656;
            border-color: #2f5656;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
        }

        .btn-primary:hover {
            background-color: #3d6160;
            border-color: #3d6160;
        }

        .btn-success {
            background-color: #4caf50;
            border: 2px solid black; /* Set border to black */
            color: white;
            font-weight: bold;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            white-space: nowrap;
        }

        .btn-success:hover {
            background-color: rgb(68, 154, 185);
            border-color: black; /* Maintain black border on hover */
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
            text-decoration: none;
        }

        .action-btn:hover {
            transform: scale(1.2);
            text-decoration: none;
        }

        .action-btn:focus,
        .action-btn:active,
        .action-btn:visited {
            text-decoration: none;
        }

        .edit-btn {
            color: #4caf50;
        }

        .edit-btn:hover {
            color: rgb(1, 179, 255);
            text-decoration: none;
        }

        .delete-btn {
            color: #f44336;
        }

        .delete-btn:hover {
            color: rgb(189, 36, 189);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="user-info">
            <div class="user-avatar">
                <img src="{{ asset('images/user.png') }}" alt="User Avatar">
            </div>
            <div class="user-role">
                Owner
            </div>
            <button class="logout-btn" onclick="window.location.href='{{route('login') }}'">Logout</button>
        </div>
        <h1>CV Agro Citra Indonesia</h1>
    </header>

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
        <a href="{{ route('kelola_user') }}">
            <button class="nav-btn {{ request()->is('owner/kelola-user') ? 'active' : '' }}">kelola user</button>
        </a>
    </div>

    <div class="section-header">
        @yield('section-header')
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>