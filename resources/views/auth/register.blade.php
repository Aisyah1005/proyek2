<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Dimsum Lindy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff0f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }

        .register-box h2 {
            color: #dc3545;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-label {
            margin-top: 15px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-register {
            background-color: #dc3545;
            color: white;
            width: 100%;
            margin-top: 25px;
            border-radius: 8px;
        }

        .btn-register:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="register-box">
        <h2>Register Akun</h2>

        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input id="name" type="text" name="name" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control" required />
            </div>

            <div class="mb-3">
    <label for="role" class="form-label">Daftar Sebagai</label>
    <select class="form-control" id="role" name="role">
        <option value="customer">Customer</option>
        <option value="owner">admin</option> <!-- ✅ BETUL -->
    </select>
</div>


            <button type="submit" class="btn btn-register">Register</button>
        </form>
    </div>

</body>
</html>
