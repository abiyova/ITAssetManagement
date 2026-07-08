<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Laporan</h4>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('reports.asset') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-box-seam fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-bold">Laporan Aset</h5>
                        <p class="card-text text-muted">Daftar seluruh aset beserta detail informasinya</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('reports.assignment') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-person-check fs-1 text-success mb-3"></i>
                        <h5 class="card-title fw-bold">Laporan Peminjaman</h5>
                        <p class="card-text text-muted">Riwayat peminjaman dan pengembalian aset</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('reports.transfer') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-arrow-left-right fs-1 text-warning mb-3"></i>
                        <h5 class="card-title fw-bold">Laporan Perpindahan</h5>
                        <p class="card-text text-muted">Riwayat perpindahan aset antar lokasi</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('reports.maintenance') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-tools fs-1 text-info mb-3"></i>
                        <h5 class="card-title fw-bold">Laporan Maintenance</h5>
                        <p class="card-text text-muted">Riwayat dan biaya maintenance aset</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('reports.warranty') }}" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-shield-check fs-1 text-danger mb-3"></i>
                        <h5 class="card-title fw-bold">Laporan Garansi</h5>
                        <p class="card-text text-muted">Status garansi seluruh aset</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
