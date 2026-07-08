<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Maintenance</h4>
        <a href="{{ route('maintenances.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Maintenance
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Dijadwalkan</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <select name="type" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Jenis</option>
                    <option value="preventive" {{ request('type') == 'preventive' ? 'selected' : '' }}>Preventive</option>
                    <option value="corrective" {{ request('type') == 'corrective' ? 'selected' : '' }}>Korektif</option>
                </select>
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-funnel"></i> Filter</button>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Kode Aset</th>
                            <th>Jenis</th>
                            <th>Teknisi</th>
                            <th>Jadwal</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenances as $maintenance)
                            <tr>
                                <td class="ps-3">{{ ($maintenances->currentPage() - 1) * $maintenances->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $maintenance->asset->asset_code ?? '-' }}</code></td>
                                <td>
                                    @if($maintenance->type == 'preventive')
                                        <span class="badge bg-info">Preventive</span>
                                    @else
                                        <span class="badge bg-warning">Korektif</span>
                                    @endif
                                </td>
                                <td>{{ $maintenance->technician->name ?? '-' }}</td>
                                <td>{{ $maintenance->schedule_date?->format('d/m/Y') ?? '-' }}</td>
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
                                <td class="text-end pe-3">
                                    <a href="{{ route('maintenances.edit', $maintenance) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $maintenances->links() }}
        </div>
    </div>
</x-app-layout>
