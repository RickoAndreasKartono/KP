<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password - CV Agro Citra Indonesia</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">

  <!-- Font Awesome (optional, bisa dihapus jika tidak dipakai) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Potta One', cursive;
      background: linear-gradient(to bottom, #D0F3E8 24%, #D1D1D1 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 20px;
    }
    h1 {
      font-size: 48px;
      color: #000;
      margin-bottom: 40px;
      text-align: center;
    }
    .form-container {
      background: rgba(255, 255, 255, 0.5);
      border-radius: 12px;
      padding: 40px 30px;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    label {
      font-family: 'M PLUS 1p', sans-serif;
      font-weight: 700;
      font-size: 18px;
      color: #000;
      display: block;
      margin-bottom: 8px;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border-radius: 8px;
      border: 2px solid #000;
      background: #d0f3e8;
      font-size: 18px;
      margin-bottom: 20px;
    }
    button {
      width: 100%;
      padding: 14px;
      font-size: 22px;
      border-radius: 12px;
      border: none;
      background-color: #7e7e7e;
      color: white;
      font-family: 'M PLUS 1p', sans-serif;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #6e6e6e;
    }
    .message-success {
      color: green;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }
    .message-error {
      color: red;
      margin-bottom: 20px;
      font-size: 16px;
    }
    ul {
      padding-left: 20px;
    }
    ul li {
      margin-bottom: 6px;
    }
  </style>
</head>
<body>

  <h1>Reset Password</h1>

  <div class="form-container">
    @if (session('status'))
      <p class="message-success">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      {{ csrf_field() }}
      <input type="hidden" name="token" value="{{ $token }}">

      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />

      <label for="password">Password Baru</label>
      <input id="password" type="password" name="password" required />

      <label for="password_confirmation">Konfirmasi Password</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required />

      <button type="submit">Reset Password</button>
    </form>

    @if ($errors->any())
      <div class="message-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

</body>
</html>