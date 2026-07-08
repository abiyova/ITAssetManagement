<section>
    <header>
        <h6 class="fw-bold">{{ __('Ubah Password') }}</h6>
        <p class="text-muted small">{{ __('Pastikan akun Anda menggunakan password yang panjang dan acak untuk keamanan.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i>{{ __('Simpan') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Tersimpan.') }}
                </span>
            @endif
        </div>
    </form>
</section>
