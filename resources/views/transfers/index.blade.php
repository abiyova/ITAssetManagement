<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Perpindahan Aset</h4>
        <a href="{{ route('transfers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Perpindahan
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
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
                            <th>Dari Lokasi</th>
                            <th>Ke Lokasi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $transfer)
                            <tr>
                                <td class="ps-3">{{ ($transfers->currentPage() - 1) * $transfers->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $transfer->asset->asset_code ?? '-' }}</code></td>
                                <td>{{ $transfer->fromLocation->name ?? '-' }}</td>
                                <td>{{ $transfer->toLocation->name ?? '-' }}</td>
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
                                <td class="text-end pe-3">
                                    <a href="{{ route('transfers.edit', $transfer) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('transfers.destroy', $transfer) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $transfers->links() }}
        </div>
    </div>
</x-app-layout>
