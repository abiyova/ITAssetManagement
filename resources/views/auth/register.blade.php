<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%); min-height: 100vh; }
        .register-card { max-width: 480px; margin: auto; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="register-card w-100 mx-3">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-box-seam-fill text-primary fs-1"></i>
                    <h4 class="fw-bold mt-2">AssetInsight</h4>
                    <p class="text-muted">Buat Akun Baru</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Masukkan email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-person-plus me-1"></i>Daftar
                    </button>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="small text-decoration-none">Masuk</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
