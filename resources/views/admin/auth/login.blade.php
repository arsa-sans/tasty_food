<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Tasty Food</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            background: linear-gradient(135deg, #1a2035 0%, #121624 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .login-header {
            padding: 30px 30px 10px;
            text-align: center;
        }
        .login-body {
            padding: 20px 30px 35px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h2 class="fw-bold mb-1 text-dark">
                <span class="text-warning">Tasty</span> Food
            </h2>
            <h5 class="text-secondary fw-semibold">Admin Login</h5>
            <p class="text-muted small">Silakan masuk ke akun admin Anda</p>
        </div>

        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold small text-secondary">Email atau Username</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', 'admin@tastyfood.com') }}" placeholder="admin@tastyfood.com" autofocus required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small text-secondary">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember" checked>
                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    MASUK
                </button>
            </form>
            
            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    &larr; Kembali ke Website
                </a>
            </div>
        </div>
    </div>

</body>
</html>
