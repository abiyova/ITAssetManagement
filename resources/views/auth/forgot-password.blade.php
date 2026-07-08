<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); min-height: 100vh; }
        .forgot-card { max-width: 420px; margin: auto; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="forgot-card w-100 mx-3">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-box-seam-fill text-primary fs-1"></i>
                    <h4 class="fw-bold mt-2">Lupa Password</h4>
                    <p class="text-muted">Masukkan email Anda untuk reset password</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success small">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-send me-1"></i>Kirim Link Reset
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
