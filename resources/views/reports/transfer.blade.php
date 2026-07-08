<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Laporan Perpindahan</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.export-pdf', 'transfer') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
            </a>
            <a href="{{ route('reports.export-excel', 'transfer') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-file-earmark-excel me-1"></i>Excel
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-funnel me-1"></i>Filter</button>
                    <a href="{{ route('reports.transfer') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Dari Lokasi</th>
                            <th>Ke Lokasi</th>
                            <th>Dipindahkan Oleh</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $index => $transfer)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td><code>{{ $transfer->asset->asset_code ?? '-' }}</code></td>
                                <td>{{ $transfer->asset->name ?? '-' }}</td>
                                <td>{{ $transfer->fromLocation->name ?? '-' }}</td>
                                <td>{{ $transfer->toLocation->name ?? '-' }}</td>
                                <td>{{ $transfer->transferredBy->name ?? '-' }}</td>
                                <td>{{ $transfer->transfer_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>
                                    @switch($transfer->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Menunggu</span>
                                            @break
                                        @case('approved')
                                            <span class="badge bg-info">Disetujui</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">Selesai</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
