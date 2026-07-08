<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Log Aktivitas</h4>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <select name="action" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Aksi</option>
                    <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Dibuat</option>
                    <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Diperbarui</option>
                    <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Dihapus</option>
                    <option value="assigned" {{ request('action') == 'assigned' ? 'selected' : '' }}>Dipinjamkan</option>
                    <option value="returned" {{ request('action') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="transferred" {{ request('action') == 'transferred' ? 'selected' : '' }}>Dipindahkan</option>
                    <option value="maintenance_scheduled" {{ request('action') == 'maintenance_scheduled' ? 'selected' : '' }}>Maintenance Dijadwalkan</option>
                    <option value="maintenance_completed" {{ request('action') == 'maintenance_completed' ? 'selected' : '' }}>Maintenance Selesai</option>
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
                            <th>Waktu</th>
                            <th>Pengguna</th>
                            <th>Aksi</th>
                            <th>Tipe</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td class="ps-3">{{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}</td>
                                <td>{{ $log->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                <td>{{ $log->user->name ?? '-' }}</td>
                                <td>
                                    @switch($log->action)
                                        @case('created')
                                            <span class="badge bg-success">Dibuat</span>
                                            @break
                                        @case('updated')
                                            <span class="badge bg-primary">Diperbarui</span>
                                            @break
                                        @case('deleted')
                                            <span class="badge bg-danger">Dihapus</span>
                                            @break
                                        @case('assigned')
                                            <span class="badge bg-info">Dipinjamkan</span>
                                            @break
                                        @case('returned')
                                            <span class="badge bg-secondary">Dikembalikan</span>
                                            @break
                                        @case('transferred')
                                            <span class="badge bg-warning">Dipindahkan</span>
                                            @break
                                        @case('maintenance_scheduled')
                                            <span class="badge bg-primary">Maintenance Dijadwalkan</span>
                                            @break
                                        @case('maintenance_completed')
                                            <span class="badge bg-success">Maintenance Selesai</span>
                                            @break
                                        @default
                                            <span class="badge bg-light text-dark">{{ $log->action }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($log->subject_type)
                                        <code>{{ class_basename($log->subject_type) }}</code>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><code>{{ $log->ip_address ?? '-' }}</code></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
