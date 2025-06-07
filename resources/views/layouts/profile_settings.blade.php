<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'User Profile') - CV Agro Citra Indonesia</title>

    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   <style>
  /* Reset & Latar Belakang Body */
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'M PLUS 1p', sans-serif;
    background: linear-gradient(to bottom, #D0F3E8 24%, #D1D1D1 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  /* KARTU PROFIL UTAMA */
  .profile-card {
    max-width: 420px; /* DIKECILKAN LAGI - dari 480px */
    width: 100%;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
  }
  .profile-card:hover {
    transform: translateY(-5px);
  }

  /* HEADER PROFIL (Bagian Atas dengan Avatar dan Nama) */
  .profile-header {
    background: linear-gradient(135deg, #3d6160, #4f7e7c);
    padding: 25px 20px; /* DIKECILKAN LAGI */
    text-align: center;
    position: relative;
    color: #fff;
  }
  .profile-avatar {
    width: 100px; /* DIKECILKAN LAGI - dari 120px */
    height: 100px; /* DIKECILKAN LAGI - dari 120px */
    border-radius: 50%;
    border: 4px solid #d0f3e8;
    object-fit: cover;
    margin-bottom: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
  }
  .user-name {
    font-family: 'Potta One', cursive;
    font-size: 28px; /* DIKECILKAN LAGI - dari 32px */
    font-weight: 500;
    margin: 0;
  }

  /* BODY PROFIL (Bagian Bawah dengan Form) */
  .profile-body {
    padding: 20px 25px; /* DIKECILKAN LAGI */
    background-color: #f8f9fa;
  }

  /* Tombol Kembali */
  .btn-back {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    color: #3d6160;
    font-weight: 700;
    margin-bottom: 20px;
    transition: color 0.2s ease;
  }
  .btn-back i {
    margin-right: 8px;
  }
  .btn-back:hover {
    color: #2c4746;
    text-decoration: underline;
  }

  .form-title {
    font-family: 'Potta One', cursive;
    text-align: center;
    font-size: 20px; /* DIKECILKAN LAGI - dari 22px */
    color: #3d6160;
    margin-bottom: 20px; /* DIKECILKAN LAGI */
  }
  
  .form-group {
      margin-bottom: 15px; /* DIKECILKAN LAGI - dari 18px */
  }
  .form-group label {
    color: #555;
    font-size: 14px; /* DIKECILKAN LAGI - dari 15px */
    font-weight: 700;
    margin-bottom: 6px; /* DIKECILKAN LAGI */
    display: block;
  }

  .form-control {
    width: 100%;
    background-color: #fff;
    color: #333;
    padding: 10px 14px; /* DIKECILKAN LAGI */
    border-radius: 8px;
    border: 2px solid #ddd;
    font-size: 15px; /* DIKECILKAN LAGI, 16px ke 15px masih aman */
    font-weight: 700;
    font-family: 'M PLUS 1p', sans-serif;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  .form-control:focus {
    outline: none;
    border-color: #3d6160;
    box-shadow: 0 0 0 3px rgba(61, 97, 96, 0.2);
  }
  .form-control[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
    color: #6c757d;
  }
  .error-message {
    color: #d9534f;
    font-size: 13px; /* DIKECILKAN LAGI */
    margin-top: 5px;
    display: block;
  }
  
  .actions-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px; /* DIKECILKAN LAGI */
    gap: 15px;
  }

  .btn {
    padding: 10px 18px; /* DIKECILKAN LAGI */
    border-radius: 8px;
    font-size: 15px; /* DIKECILKAN LAGI - dari 16px */
    font-family: 'Potta One', cursive;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    border: none;
    transition: all 0.2s ease;
    flex-grow: 1;
  }
  
  .btn-save {
    background: #3d6160;
    color: #fff;
  }
  .btn-save:hover {
    background: #2c4746;
    transform: scale(1.02);
  }

  .btn-logout {
    background: #f1f1f1;
    color: #a95151;
    border: 2px solid #e7e7e7;
  }
  .btn-logout:hover {
    background: #e7e7e7;
    color: #c26b6b;
    transform: scale(1.02);
  }
  
  .alert.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 12px; /* DIKECILKAN LAGI */
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
  }
</style>
</head>
<body>
    @yield('content')
</body>
</html>