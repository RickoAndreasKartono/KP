<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CV Agro Citra Indonesia – Login</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Potta One', cursive;
      background: linear-gradient(to bottom, #D0F3E8 24%, #D1D1D1 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    h1 {
      font-size: 50px;
      color: #000;
      margin-bottom: 40px;
    }

    .login-container {
      display: flex;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 12px;
      overflow: hidden;
      max-width: 900px;
      width: 90%;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar-col {
      flex: 1;
      background: transparent;
      text-align: center;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .avatar-col img {
      width: 180px;
      height: 180px;
      border: 4px solid #000;
      border-radius: 50%;
      background: #fff;
    }

    .avatar-col h2 {
      margin-top: 20px;
      font-size: 24px;
      color: #000;
    }

    .form-col {
      flex: 1.3;
      background: #3d6160;
      border-left: 2px solid #fff;
      padding: 40px 30px;
      position: relative;
    }

    .form-col h1 {
      text-align: center;
      color: #fff;
      margin-bottom: 30px;
      font-size: 40px;
    }

    .form-group label,
    .forgot-password,
    .error-message {
      font-family: 'M PLUS 1p', sans-serif;
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-group label {
      display: block;
      color: #fff;
      margin-bottom: 8px;
      font-size: 20px;
    }

    .form-group input {
      width: 100%;
      padding: 12px 16px;
      border-radius: 8px;
      border: 2px solid #000;
      background: #d0f3e8;
      font-size: 18px;
    }

    .forgot-password {
      display: block;
      margin-bottom: 30px;
      color:rgb(57, 240, 222);
      text-decoration: none;
      font-size: 16px;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .btn-login {
      display: block;
      width: 200px;
      margin: 0 auto;
      padding: 12px;
      text-align: center;
      background: #7e7e7e;
      color: #fff;
      border: 2px solid #ccc;
      border-radius: 12px;
      font-size: 25px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-login:hover {
      background: #6e6e6e;
    }

    .error-message {
      color:rgb(255, 140, 142);
      margin-top: 10px;
      text-align: center;
      margin-bottom: 10px;
      font-size: 16px;
    }

    .success-message {
      color: rgb(151, 255, 167);
      margin-bottom: 15px;
      text-align: center;
      font-size: 16px;
    }
  </style>
</head>
<body>

  <h1>CV Agro Citra Indonesia</h1>

  <div class="login-container">
    <div class="avatar-col">
      <img src="images/user.png" alt="User">
      <h2>Welcome Back!</h2>
    </div>

    <div class="form-col">
      <form id="login-form" method="POST" action="{{ url('login_post') }}">
        {{ csrf_field() }}

        <h1>Login</h1>

        <!-- Global error message (from validator or session flash) -->
        @if ($errors->any())
          <div class="error-message">
            <ul style="list-style: none; padding: 0;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('error'))
          <div class="error-message">
            {{ session('error') }}
          </div>
        @endif

        @if (session('status'))
          <div class="success-message">
            {{ session('status') }}
          </div>
        @endif

        <div class="form-group">
          <label for="email">Email</label>
          <input
            id="email"
            type="email"
            value="{{ old('email') }}"
            name="email"
            required
          >
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            id="password"
            type="password"
            name="password"
            required
          >
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <a href="{{ url('forgot') }}" class="forgot-password">Forgot Password?</a>

        <button type="submit" class="btn-login">Login</button>

      </form>
    </div>
  </div>
</body>
</html>
