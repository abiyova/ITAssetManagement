<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Vendor</h4>
        <a href="{{ route('vendors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Vendor
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari vendor..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Nama</th>
                            <th>Kontak</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Jumlah Aset</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr>
                                <td class="ps-3">{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->iteration }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->contact_person ?? '-' }}</td>
                                <td>{{ $vendor->email ?? '-' }}</td>
                                <td>{{ $vendor->phone ?? '-' }}</td>
                                <td><span class="badge bg-info">{{ $vendor->assets_count ?? 0 }}</span></td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('vendors.destroy', $vendor) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            {{ $vendors->links() }}
        </div>
    </div>
</x-app-layout>
