<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password - CV Agro Citra Indonesia</title>
  <style>

     h1 {
      font-size: 50px; /* Menggunakan px untuk ukuran font */
      color: #000; /* Warna hitam */
      margin-bottom: 40px; /* Menambahkan jarak antara judul dan login-container */
    }

    
    body {
      font-family: 'Inria Sans', sans-serif;
      background: linear-gradient(to bottom, #D0F3E8 24%, #D1D1D1 100%);
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin: 0;
    }  

    p {
      font-family: 'M PLUS 1p', sans-serif;
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 40px;
      text-align: center;
    }

    .reset-container {
      width: 100%;
      max-width: 500px;
      background-color: #37716D;
      border-radius: 16px;
      border: 2px solid white;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-group {
      width: 100%;
      margin-bottom: 25px;
    }

    .form-group label {
      font-family: 'M PLUS 1p', sans-serif;
      font-size: 1rem;
      color: white;
      display: block;
      margin-bottom: 10px;
    }

    .form-group input {
      font-family: 'M PLUS 1p', sans-serif;
      width: 100%;
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
      box-sizing: border-box;
    }

    .btn-reset {
      font-family: 'M PLUS 1p', sans-serif;
      padding: 10px 20px;
      background-color: #6E9EA3;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      max-width: 300px;
    }

    .btn-reset:hover {
      background-color: rgb(60, 121, 130);
    }

    /* Styling untuk error dan success messages */
    .alert {
      padding: 15px;
      margin-top: 20px;
      border-radius: 5px;
      font-size: 1rem;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .alert-success {
      background-color: #4caf50;
      color: white;
    }

    .alert-error {
      background-color: #f44336;
      color: white;
    }

    /* Responsiveness */
    @media (max-width: 600px) {
      .reset-container {
        padding: 30px 20px;
      }

      h1 {
        font-size: 1.5rem;
      }

      p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <h1>CV Agro Citra Indonesia</h1>
  <p>Enter your new password</p>

  <div class="reset-container">
    <!-- Menampilkan pesan notifikasi jika ada -->
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form untuk Reset Password -->
    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      <!-- New Password Field -->
      <div class="form-group">
        <label for="password">New Password</label>
        <input id="password" type="password" name="password" placeholder="Enter your new password" required>
      </div>

      <!-- Password Confirmation Field -->
      <div class="form-group">
        <label for="password_confirmation">Confirm New Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm your new password" required>
      </div>

      <button type="submit" class="btn-reset">Reset Password</button>
    </form>
  </div>

  @if(session('status'))
    <div>{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</body>
</html>
