<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .login-container {
            height: 100vh;
            display: flex;
        }

        /* Animasi */
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Gambar kiri */
        .login-image {
            flex: 1;
            position: relative;
            background: url('{{ asset('storage/login/gambar3.jpg') }}') center/cover no-repeat;
            animation: slideInLeft 1.2s ease forwards;
        }

        .login-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .image-text {
            position: absolute;
            z-index: 2;
            color: white;
            text-align: center;
            width: 100%;
            top: 50%;
            transform: translateY(-50%);
            padding: 0 20px;
            animation: slideInLeft 1.2s ease forwards;
        }

        .image-text h2 {
            font-weight: bold;
            font-size: 2rem;
        }

        .image-text p {
            font-size: 1rem;
            opacity: 0.85;
        }

        /* Form kanan */
        .login-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            padding: 40px;
            animation: slideInRight 1.2s ease forwards;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-card h4 {
            text-align: center;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0b5ed7;
            box-shadow: 0 4px 12px rgba(13,110,253,0.4);
        }

        .footer-text {
            text-align: center;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 15px;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .login-image, .login-form {
                flex: none;
                height: 50vh;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Gambar kiri -->
    <div class="login-image">
        <div class="image-text">
            <h2>Selamat Datang</h2>
            <p>Silakan login untuk mengakses dashboard admin</p>
        </div>
    </div>

    <!-- Form kanan -->
    <div class="login-form">
        <div class="login-card">
            <h4>Login Admin</h4>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="rememberCheck">
                    <label class="form-check-label" for="rememberCheck">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Masuk</button>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
            <div class="footer-text">
                &copy; {{ date('Y') }} Admin Dashboard. Semua hak dilindungi.
            </div>
        </div>
    </div>
</div>

</body>
</html>
