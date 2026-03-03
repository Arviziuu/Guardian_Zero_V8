<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Guardian Zero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f4c5c, #1AA6A6);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .login-header {
            text-align: center;
            padding: 35px 25px 20px;
        }

        .login-header img {
            width: 120px;
            margin-bottom: 15px;
        }

        .login-header h4 {
            color: #0f4c5c;
            font-weight: 600;
            margin: 0;
        }

        .login-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 500;
            color: #0f4c5c;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: #1AA6A6;
            box-shadow: 0 0 0 0.15rem rgba(26,166,166,0.25);
        }

        .btn-login {
            background: #1AA6A6;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #148b8b;
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 12px;
            font-size: 14px;
        }

    </style>
</head>

<body>

<div class="login-card">
    <div class="login-header">
        <img src="{{ asset('img/logo.png') }}" alt="Guardian Zero">
        <h4>Ingreso al Sistema</h4>
    </div>

    <div class="login-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif


        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    name="email"
                    class="form-control"
                    required>
            </div>

            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    required>
            </div>

            <button class="btn btn-login w-100">
                Ingresar
            </button>
        </form>
    </div>
</div>

</body>
</html>