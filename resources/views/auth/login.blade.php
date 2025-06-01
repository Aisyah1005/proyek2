<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Dimsum Lindy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8d7da;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            color: #dc3545;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-login {
            background-color: #dc3545;
            color: white;
            width: 100%;
            border-radius: 8px;
        }

        .btn-login:hover {
            background-color: #c82333;
        }

        .btn-dashboard {
            margin-top: 10px;
            background-color: #6c757d;
            color: white;
            width: 100%;
            border-radius: 8px;
            text-align: center;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .btn-dashboard:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login Dimsum Lindy</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus />
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>

        
    </div>

</body>
</html>
