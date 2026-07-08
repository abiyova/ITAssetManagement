<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Laporan Maintenance</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.export-pdf', 'maintenance') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
            </a>
            <a href="{{ route('reports.export-excel', 'maintenance') }}" class="btn btn-outline-success btn-sm">
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
                    <label class="form-label">Jenis</label>
                    <select name="type" class="form-select form-select-sm">
                        <option value="">Semua Jenis</option>
                        <option value="preventive" {{ request('type') == 'preventive' ? 'selected' : '' }}>Preventive</option>
                        <option value="corrective" {{ request('type') == 'corrective' ? 'selected' : '' }}>Korektif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-funnel me-1"></i>Filter</button>
                    <a href="{{ route('reports.maintenance') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="fw-bold text-primary mb-0">{{ $maintenances->count() }}</h3>
                    <small class="text-muted">Total Maintenance</small>
                </div>
                <div class="col-md-4">
                    <h3 class="fw-bold text-danger mb-0">Rp {{ number_format($totalCost, 0, ',', '.') }}</h3>
                    <small class="text-muted">Total Biaya</small>
                </div>
            </div>
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
                            <th>Jenis</th>
                            <th>Teknisi</th>
                            <th>Jadwal</th>
                            <th>Selesai</th>
                            <th>Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenances as $index => $maintenance)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td><code>{{ $maintenance->asset->asset_code ?? '-' }}</code></td>
                                <td>{{ $maintenance->asset->name ?? '-' }}</td>
                                <td>
                                    @if($maintenance->type == 'preventive')
                                        <span class="badge bg-info">Preventive</span>
                                    @else
                                        <span class="badge bg-warning">Korektif</span>
                                    @endif
                                </td>
                                <td>{{ $maintenance->technician->name ?? '-' }}</td>
                                <td>{{ $maintenance->schedule_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $maintenance->end_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>Rp {{ number_format($maintenance->cost ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    @switch($maintenance->status)
                                        @case('scheduled')
                                            <span class="badge bg-primary">Dijadwalkan</span>
                                            @break
                                        @case('in_progress')
                                            <span class="badge bg-warning">Berlangsung</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">Selesai</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">Dibatalkan</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
