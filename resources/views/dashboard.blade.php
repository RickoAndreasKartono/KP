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
      padding: 10px 20px;
      background-color: #2f5656;
    }

    header h1 {
      font-family: 'Potta One', cursive;
      color: #fff;
      font-size: 24px;
    }

    .user-avatar {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-avatar img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    .navbar {
      display: flex;
      gap: 10px;
      margin: 20px 0;
    }

    .navbar button {
      padding: 10px 20px;
      border: none;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      font-weight: bold;
      color: #2f5656;
    }

    .navbar button.active {
      background-color: #e4e4e4;
    }

    .container {
      background-color: #d1e9e7;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      margin-bottom: 10px;
      font-size: 18px;
    }

    .container .add-btn {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 8px 12px;
      background-color: #4caf50;
      color: white;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      width: fit-content;
    }

    .search-bar {
      margin-bottom: 20px;
      display: flex;
      justify-content: flex-end;
    }

    .search-bar input {
      padding: 8px 12px;
      border: 2px solid #ccc;
      border-radius: 8px;
      outline: none;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      text-align: center;
      padding: 12px;
      border-bottom: 1px solid #ccc;
    }

    table th {
      background-color: #3d6160;
      color: white;
    }

    table img {
      width: 50px;
      height: 50px;
      border-radius: 6px;
    }

    .action-btns i {
      cursor: pointer;
      padding: 5px;
      font-size: 18px;
      border-radius: 50%;
      margin: 0 5px;
      color: white;
    }

    .action-btns .edit {
      background-color: #2196f3;
    }

    .action-btns .delete {
      background-color: #f44336;
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
    <button class="active">stok pupuk</button>
    <button>stok masuk</button>
    <button>stok keluar</button>
    <button>laporan stok</button>
    <button>manajemen pembelian</button>
    <button>validasi transaksi</button>
    <button>kelola user</button>
  </div>

  <!-- Content -->
  <div class="container">
    <h2>Data Stok Pupuk</h2>
    <div class="add-btn">
      <i class="fas fa-plus"></i> add
    </div>
    <div class="search-bar">
      <input type="text" placeholder="search...">
    </div>
    <table>
      <thead>
        <tr>
          <th>Nama Pupuk</th>
          <th>Jumlah Tersedia</th>
          <th>Lokasi Simpan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <img src="https://via.placeholder.com/50" alt="Pupuk">
            Pupuk Urea (N)
          </td>
          <td>20</td>
          <td>.....</td>
          <td class="action-btns">
            <i class="fas fa-pen edit"></i>
            <i class="fas fa-trash delete"></i>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://via.placeholder.com/50" alt="Pupuk">
            Pupuk Urea (N)
          </td>
          <td>20</td>
          <td>.....</td>
          <td class="action-btns">
            <i class="fas fa-pen edit"></i>
            <i class="fas fa-trash delete"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
