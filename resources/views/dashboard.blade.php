<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - CV Agro Citra Indonesia</title>

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
      margin-bottom: 40px;
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
    }

    .add-btn:hover {
      background-color:rgb(68, 154, 185); /* Hover color */
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

    /* Change placeholder color */
    .search-bar input::placeholder {
      color: white;
    }

    .container {
      display: none;
      background-color: #d1e9e7;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container.active {
      display: block;
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
      color:rgb(1, 179, 255);
    }

    .delete-btn {
      color: #f44336;
    }

    .delete-btn:hover {
      color:rgb(189, 36, 189);
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="user-avatar">
      <img src="images/user.png" alt="User Avatar">
    </div>
    <h1>CV Agro Citra Indonesia</h1>
  </header>

  <!-- Navbar -->
  <div class="navbar">
    <button class="nav-btn active" data-target="stok-pupuk">stok pupuk</button>
    <button class="nav-btn" data-target="stok-masuk">stok masuk</button>
    <button class="nav-btn" data-target="stok-keluar">stok keluar</button>
    <button class="nav-btn" data-target="laporan-stok">laporan stok</button>
    <button class="nav-btn" data-target="manajemen pembelian">manajemen pembelian</button>
    <button class="nav-btn" data-target="validasi-transaksi">validasi transaksi</button>
    <button class="nav-btn" data-target="kelola-user">kelola user</button>
  </div>

  <!-- Section Header -->
  <div class="section-header">
    <h2>Data Stok Pupuk</h2>
    <div class="controls">
      <div class="add-btn">
        <i class="fas fa-plus"></i> add
      </div>
      <div class="search-bar">
        <input type="text" placeholder="search...">
      </div>
    </div>
  </div>

  <!-- Content -->
  <div id="stok-pupuk" class="container active">
    <table>
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Pupuk</th>
          <th>Jumlah Tersedia</th>
          <th>Lokasi Simpan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="images/pupuk-urea.jpg" alt="Pupuk Urea" width="50" height="50"></td>
          <td>Pupuk Urea (N)</td>
          <td>20</td>
          <td>Gudang A</td>
          <td>
            <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
            <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="stok-masuk" class="container">
    <h2>Data Stok Masuk</h2>
    <!-- Content for Stok Masuk -->
  </div>

  <div id="stok-keluar" class="container">
    <h2>Data Stok Keluar</h2>
    <!-- Content for Stok Keluar -->
  </div>

  <script>
    const buttons = document.querySelectorAll('.nav-btn');
    const containers = document.querySelectorAll('.container');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(btn => btn.classList.remove('active'));
        containers.forEach(container => container.classList.remove('active'));

        button.classList.add('active');
        document.getElementById(button.dataset.target).classList.add('active');
      });
    });
  </script>
</body>
</html>
