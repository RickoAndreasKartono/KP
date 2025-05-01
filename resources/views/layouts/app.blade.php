<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV Agro Citra Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #316d6c;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #eeeeee;
            padding: 10px;
        }
        .navbar button {
            margin-right: 10px;
        }
        .content {
            background: linear-gradient(to right, #dff6f5, #b7e4e2);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .table img {
            width: 80px;
        }
        .aksi-button {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-3">
        <div class="d-flex align-items-center">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" width="40" alt="User Icon">
            <span class="ms-2 text-white">CV Agro Citra Indonesia</span>
        </div>
    </div>

    <div class="navbar d-flex justify-content-start">
        <button class="btn btn-warning">stok pupuk</button>
        <button class="btn btn-light">stok masuk</button>
        <button class="btn btn-light">stok keluar</button>
        <button class="btn btn-light">transaksi</button>
        <button class="btn btn-light">kelola user</button>
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>
</div>

</body>
</html>
