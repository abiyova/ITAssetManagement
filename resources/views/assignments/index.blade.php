<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Peminjaman Aset</h4>
        <a href="{{ route('assignments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Peminjaman
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
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
                            <th>Nama Aset</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td class="ps-3">{{ ($assignments->currentPage() - 1) * $assignments->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $assignment->asset->asset_code ?? '-' }}</code></td>
                                <td>{{ $assignment->asset->name ?? '-' }}</td>
                                <td>{{ $assignment->assignedTo->name ?? '-' }}</td>
                                <td>{{ $assignment->assign_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $assignment->return_date?->format('d/m/Y') ?? '-' }}</td>
                                <td>
                                    @if($assignment->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    @if($assignment->status == 'active')
                                        <form method="POST" action="{{ route('assignments.return', $assignment) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Kembalikan">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('assignments.destroy', $assignment) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            {{ $assignments->links() }}
        </div>
    </div>
</x-app-layout>
