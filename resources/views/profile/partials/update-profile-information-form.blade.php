<section>
    <header>
        <h6 class="fw-bold">{{ __('Informasi Profil') }}</h6>
        <p class="text-muted small">{{ __("Perbarui informasi profil dan alamat email akun Anda.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="form-text text-warning">
                    {{ __('Email belum diverifikasi.') }}
                    <button form="send-verification" class="btn btn-link btn-sm p-0">
                        {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="form-text text-success">
                        {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i>{{ __('Simpan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Tersimpan.') }}
                </span>
            @endif
        </div>
    </form>
</section>
