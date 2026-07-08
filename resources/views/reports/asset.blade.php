<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Laporan Aset</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.export-pdf', 'asset') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
            </a>
            <a href="{{ route('reports.export-excel', 'asset') }}" class="btn btn-outline-success btn-sm">
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
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Dipinjamkan</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="retired" {{ request('status') == 'retired' ? 'selected' : '' }}>Pensiun</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select form-select-sm">
                        <option value="">Semua Kategori</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-funnel me-1"></i>Filter</button>
                    <a href="{{ route('reports.asset') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h3 class="fw-bold text-primary mb-0">{{ $assets->count() }}</h3>
                    <small class="text-muted">Total Aset</small>
                </div>
                <div class="col-md-4">
                    <h3 class="fw-bold text-success mb-0">Rp {{ number_format($totalValue, 0, ',', '.') }}</h3>
                    <small class="text-muted">Total Nilai</small>
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
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Lokasi</th>
                            <th>Departemen</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $index => $asset)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td><code>{{ $asset->asset_code }}</code></td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category->name ?? '-' }}</td>
                                <td>{{ $asset->brand->name ?? '-' }}</td>
                                <td>{{ $asset->location->name ?? '-' }}</td>
                                <td>{{ $asset->department->name ?? '-' }}</td>
                                <td>Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    @switch($asset->status)
                                        @case('available')
                                            <span class="badge bg-success">Tersedia</span>
                                            @break
                                        @case('assigned')
                                            <span class="badge bg-primary">Dipinjamkan</span>
                                            @break
                                        @case('maintenance')
                                            <span class="badge bg-warning">Maintenance</span>
                                            @break
                                        @case('retired')
                                            <span class="badge bg-secondary">Pensiun</span>
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
