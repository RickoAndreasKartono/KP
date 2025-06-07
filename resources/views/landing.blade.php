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
            animation: bounceIn 5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards, fadeOut 3s 5s forwards;
            opacity: 0;
        }
        @keyframes bounceIn {
            0% {
                transform: scale(0) translateY(-100vh);
                opacity: 0;
            }
            40% {
                transform: scale(1.2) translateY(0);
                opacity: 1;
            }
            60% {
                transform: scale(0.9) translateY(-30px);
            }
            80% {
                transform: scale(1.05) translateY(15px);
            }
            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <h1>CV Agro Citra Indonesia</h1>
    <script>
        setTimeout(() => {
            window.location.href = '{{ url("login") }}';
        }, 8000); 
    </script>
</body>
</html>
