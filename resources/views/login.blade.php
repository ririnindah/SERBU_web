<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(180deg, #f9fafb, #eef2f7);
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card {
            max-width: 920px;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(10px);
            box-shadow: 0 30px 60px rgba(0,0,0,.12);
        }

        .login-left { padding: 56px; }
        .login-left h2 {
            font-weight: 700;
            margin-bottom: 32px;
            color: #111827;
        }

        .login-right {
            padding: 56px;
            background: rgba(17, 24, 39, 0.85);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .login-right h2 { font-weight: 800; letter-spacing: .5px; }
        .login-right p { font-size: 14px; line-height: 1.6; opacity: .9; }
        .login-right span { font-size: 12px; opacity: .6; margin-top: 16px; }

        .form-control {
            height: 48px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: rgba(255,255,255,.85);
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #9ca3af;
            box-shadow: 0 0 0 .15rem rgba(17,24,39,.15);
        }

        .btn-login {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
            background: #111827;
            color: #ffffff;
            border: none;
        }

        .btn-login:hover {
            background: #1f2937;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .login-left, .login-right { padding: 32px; text-align: center; }
            .login-left h2 { text-align: center; }
        }

        @media (max-width: 576px) {
            .login-card { border-radius: 14px; }
            .login-left, .login-right { padding: 24px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card row g-0">

        <!-- LEFT -->
        <div class="col-md-6 login-left d-flex flex-column justify-content-center">
            <h2>Sign in</h2>

            {{-- ERROR VALIDASI (misal: outlet_id kosong) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- ERROR LOGIN (outlet_id salah / tidak terdaftar) --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    <strong>Login Error</strong><br>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="mb-4">
                    <input
                        type="text"
                        name="outlet_id"
                        class="form-control"
                        placeholder="Outlet ID"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-login w-100">
                    Sign in
                </button>
            </form>
        </div>

        <!-- RIGHT -->
        <div class="col-md-6 login-right">
            <h2 class="mb-3">SELAMAT DATANG!</h2>
            <p class="mb-4">
                Selamat datang di SERBU.<br>
                Platform monitoring dan analisis performa program SERBU Circle Java.
            </p>
            <span>SERBU Web System</span>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
