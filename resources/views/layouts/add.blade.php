{{-- File: resources/views/layouts/add.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Form') - CV Agro Citra Indonesia</title>

    {{-- Link Font & Ikon Global --}}
    <link href="https://fonts.googleapis.com/css2?family=Potta+One&family=M+PLUS+1p:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* CSS Global untuk Halaman Ini */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'M PLUS 1p', sans-serif;
            background-color: #b9d8d6;
            padding: 20px;
        }
        .container {
            background-color: #d1e9e7;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* CSS Spesifik untuk Halaman Form */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .section-header h2 {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }
        .controls-right {
            display: flex;
            align-items: center;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: #909090;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            border: 2px solid #333;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color: #666;
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #2f5656;
        }

        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: block;
            font-weight: bold;
            font-size: 18px;
            color: #2f5656;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 2px solid #2f5656;
            border-radius: 8px;
            background-color: #f8f8f8;
            color: #333;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #4caf50;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }
        .form-select { cursor: pointer; }
        .form-control::placeholder { color: #888; }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 24px;
            background-color: #4caf50;
            color: white;
            border: 2px solid #333;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; border: 2px solid; }
        .alert-danger { background-color: #f8d7da; border-color: #f44336; color: #721c24; }
        .alert ul { margin: 0; padding-left: 20px; }
        .alert li { margin-bottom: 5px; font-weight: 500; }

        .password-toggle { position: relative; }
        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none; border: none; color: #666;
            cursor: pointer; font-size: 16px; padding: 4px;
        }
        .password-toggle-btn:hover { color: #2f5656; }
        .form-footer { margin-top: 30px; padding-top: 20px; border-top: 2px solid #e0e0e0; text-align: right; }

        @media (max-width: 768px) {
            .form-container { padding: 20px; }
            .section-header { flex-direction: column; gap: 15px; align-items: flex-start; }
        }
    </style>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    {{-- Tempat untuk script jika dibutuhkan --}}
    @yield('scripts')
</body>
</html>