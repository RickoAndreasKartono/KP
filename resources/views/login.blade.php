<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | CV Agro Citra Indonesia</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="title">CV Agro Citra Indonesia</div>
    <div class="content-box">
        <div class="left">
        <div class="avatar-container">
            <div class="head"></div>
             <div class="body1"></div>
        </div>
        <p>Welcome Back!</p>

        </div>
        <div class="right">
            <form action="#" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <span class="toggle" onclick="togglePassword()">👁️</span>
                </div>

                <a class="forgot" href="#">Forgot password</a>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
