<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shiksha Mitra - Enterprise School ERP Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modern-theme.css') }}">
    <style>
        body.login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 10% 20%, #1e1b4b 0%, #0f172a 90%);
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .login-card-pro {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }
        .brand-header-pro {
            background: linear-gradient(135deg, #312e81 0%, #4338ca 100%);
            padding: 2.25rem 2rem 1.75rem;
            color: #ffffff;
            text-align: center;
            position: relative;
        }
        .brand-header-pro h3 {
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0.5rem 0 0.25rem;
            font-size: 1.5rem;
        }
        .demo-credential-chip {
            cursor: pointer;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .demo-credential-chip:hover {
            border-color: #6366f1;
            background: #eef2ff;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-card-pro">
        <div class="brand-header-pro">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm p-2 mb-2" style="width: 58px; height: 58px;">
                <i class="bi bi-mortarboard-fill text-primary fs-3"></i>
            </div>
            <h3>Shiksha Mitra</h3>
            <p class="text-white-50 small mb-0">CBSE Affiliated School ERP Management System</p>
        </div>

        <div class="p-4 p-md-5">
            <h5 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.01em;">Sign in to your account</h5>
            <p class="text-muted small mb-4">Enter authorized institutional credentials to continue</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label font-weight-bold">Registered Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" placeholder="admin@mail.com" value="{{ old('email') ?? 'admin@mail.com' }}" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-weight-bold">Security Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" id="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="••••••••" value="123456" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                        <label class="form-check-label small text-muted" for="remember">Keep signed in</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary fw-semibold">Forgot?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-6 fw-bold shadow-sm">
                    Access Dashboard <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>

            <div class="mt-4 pt-3 border-top">
                <span class="text-muted small d-block mb-2 fw-semibold">Quick Demo Login:</span>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="demo-credential-chip" onclick="fillDemo('admin@mail.com', '123456')">
                            <span class="d-block fw-bold small text-dark"><i class="bi bi-shield-lock me-1 text-primary"></i>Admin</span>
                            <small class="text-muted" style="font-size: 0.72rem;">admin@mail.com</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="demo-credential-chip" onclick="fillDemo('operator@mail.com', '123456')">
                            <span class="d-block fw-bold small text-dark"><i class="bi bi-person-gear me-1 text-success"></i>Operator</span>
                            <small class="text-muted" style="font-size: 0.72rem;">operator@mail.com</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fillDemo(email, pass) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }
    </script>
</body>
</html>
