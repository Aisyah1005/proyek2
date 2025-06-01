<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dimsum Lindy - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8d7da;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .btn-custom {
            width: 150px;
            margin: 10px;
        }
    </style>
</head>
<body>

    <div class="welcome-box">
        <h1>Dimsum Lindy</h1>
        <p>Silakan login atau daftar untuk mulai memesan.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-danger btn-custom">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-danger btn-custom">Register</a>
        </div>
    </div>

</body>
</html>
