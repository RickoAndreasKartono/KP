<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Agro Citra Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Potta+One&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #D0F3E8 24%, #D1D1D1 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Potta One', cursive;
        }
        h1 {
            font-size: 3rem;
            color: black;
            animation: slideIn 5s forwards, fadeOut 3s forwards;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <h1>CV Agro Citra Indonesia</h1>
    <script>
        setTimeout(() => {
            window.location.href = 'login';
        }, 4000); // Redirect to login page after animation
    </script>
</body>
</html>