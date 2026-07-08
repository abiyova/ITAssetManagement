<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Karyawan</h4>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Karyawan
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari karyawan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            <th>ID Karyawan</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Departemen</th>
                            <th>Posisi</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td class="ps-3">{{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $employee->employee_id }}</code></td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email ?? '-' }}</td>
                                <td>{{ $employee->phone ?? '-' }}</td>
                                <td>{{ $employee->department->name ?? '-' }}</td>
                                <td>{{ $employee->position ?? '-' }}</td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('employees.destroy', $employee) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            {{ $employees->links() }}
        </div>
    </div>
</x-app-layout>
