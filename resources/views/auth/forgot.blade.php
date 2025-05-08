<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password - CV Agro Citra Indonesia</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=Inria+Sans:wght@400;700&display=swap" rel="stylesheet">
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
      font-family: 'Potta One', cursive;
      font-size: 50px;
      color: #000;
      padding-top: 50px;
      margin-bottom: 50px;
      text-align: center;
    }

    p {
      font-family: 'Inria Sans', sans-serif;
      font-size: 30px;
      color: #333;
      margin-bottom: 30px;
      text-align: center;
      font-weight: bold;
    }

    .reset-container {
      width: 500px;
      background: #37716D;
      border-radius: 16px;
      border: 2px solid white;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      font-family: 'M PLUS 1p', sans-serif;
      font-size: 20px;
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
      font-size: 18px;
      box-sizing: border-box;
    }

    .btn-reset {
      font-family: 'M PLUS 1p', sans-serif;
      padding: 5px 10px;
      background-color: #6E9EA3;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: inline-block;
    }

    .btn-reset:hover {
      background-color: rgb(60, 121, 130);
    }
  </style>
</head>
<body>
  <h1>CV Agro Citra Indonesia</h1>
  <p>Enter your email and new password</p>

  <div class="reset-container">
    <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">New Password</label>
        <input id="password" type="password" name="password" placeholder="Enter your new password" required>
      </div>
      <button type="submit" class="btn-reset">Reset</button>
    </form>
  </div>
</body>
</html>
