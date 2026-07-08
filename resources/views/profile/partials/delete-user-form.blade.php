<section>
    <header>
        <h6 class="fw-bold text-danger">{{ __('Hapus Akun') }}</h6>
        <p class="text-muted small">{{ __('Setelah akun dihapus, semua data akan dihapus secara permanen. Sebelum menghapus, pastikan sudah mengunduh data yang ingin dipertahankan.') }}</p>
    </header>

    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        <i class="bi bi-trash me-1"></i>{{ __('Hapus Akun') }}
    </button>
</section>
