<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Daftar Aset</h4>
        <a href="{{ route('assets.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Aset
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('assets.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau kode aset..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        @foreach(['draft','available','assigned','maintenance','damaged','lost','retired','disposed'] as $status)
                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="category_id" class="form-select form-select-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Kode Aset</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td class="ps-3">{{ ($assets->currentPage() - 1) * $assets->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $asset->asset_code }}</code></td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category->name ?? '-' }}</td>
                                <td>{{ $asset->brand->name ?? '-' }}</td>
                                <td>{{ $asset->location->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ match($asset->status) {
                                        'available' => 'success',
                                        'assigned' => 'info',
                                        'maintenance' => 'warning',
                                        'damaged' => 'danger',
                                        'lost' => 'dark',
                                        'retired' => 'secondary',
                                        'disposed' => 'dark',
                                        default => 'secondary',
                                    } }}">{{ ucfirst($asset->status) }}</span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('assets.show', $asset) }}" class="btn btn-outline-primary" title="Lihat"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('assets.edit', $asset) }}" class="btn btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('assets.timeline', $asset) }}" class="btn btn-outline-info" title="Timeline"><i class="bi bi-clock-history"></i></a>
                                        <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted py-4">Tidak ada data aset</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Menampilkan {{ $assets->firstItem() ?? 0 }} - {{ $assets->lastItem() ?? 0 }} dari {{ $assets->total() }} data</small>
                {{ $assets->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
