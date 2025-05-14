<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password - CV Agro Citra Indonesia</title>
  <style>
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

    h1 {
      font-family: 'M PLUS 1p', sans-serif;
      font-size: 2rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
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

    .btn-send {
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

    .btn-send:hover {
      background-color: rgb(60, 121, 130);
    }
  </style>
</head>
<body>
  <h1>CV Agro Citra Indonesia</h1>
  <p>Enter your email to change the password</p>

  <div class="reset-container">
    <form method="POST" action="{{ route('password.sendResetLink') }}">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Enter your email" required>
      </div>

      <button type="submit" class="btn-send">Send</button>
    </form>
  </div>

  @if (session('status'))
    <div>{{ session('status') }}</div>
  @endif
</body>
</html>
