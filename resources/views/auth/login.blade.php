<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shiksha Mitra - Log in</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="login-page">
    <div class="card login-card">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <img src="{{asset('backend/images/logo-dark.png')}}" alt="" height="55">
                <h4 class="mt-3 fw-bold" style="color: #0f172a;">Welcome Back</h4>
                <p class="text-muted">Sign in to continue to Shiksha Mitra</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-decoration-none small">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 btn-lg">Sign In</button>
            </form>

            @if (Route::has('register'))
            <div class="text-center mt-4">
                <p class="text-muted small mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Sign Up</a></p>
            </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
