<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Laporan Garansi</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.export-pdf', 'warranty') }}" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
            </a>
            <a href="{{ route('reports.export-excel', 'warranty') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-file-earmark-excel me-1"></i>Excel
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
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
                            <th>Departemen</th>
                            <th>Akhir Garansi</th>
                            <th>Sisa Hari</th>
                            <th>Status Garansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $index => $asset)
                            @php
                                $warrantyEnd = $asset->warranty_end_date;
                                $now = now();
                                if ($warrantyEnd && $warrantyEnd->lt($now)) {
                                    $warrantyStatus = 'expired';
                                    $remainingDays = $now->diffInDays($warrantyEnd, false) * -1;
                                } elseif ($warrantyEnd && $warrantyEnd->lte($now->copy()->addDays(30))) {
                                    $warrantyStatus = 'expiring';
                                    $remainingDays = $now->diffInDays($warrantyEnd);
                                } else {
                                    $warrantyStatus = 'active';
                                    $remainingDays = $now->diffInDays($warrantyEnd);
                                }
                            @endphp
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td><code>{{ $asset->asset_code }}</code></td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category->name ?? '-' }}</td>
                                <td>{{ $asset->brand->name ?? '-' }}</td>
                                <td>{{ $asset->department->name ?? '-' }}</td>
                                <td>{{ $warrantyEnd?->format('d/m/Y') ?? '-' }}</td>
                                <td>
                                    @if($warrantyStatus == 'expired')
                                        <span class="text-danger fw-bold">0 hari</span>
                                    @else
                                        <span class="fw-bold">{{ $remainingDays }} hari</span>
                                    @endif
                                </td>
                                <td>
                                    @if($warrantyStatus == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($warrantyStatus == 'expiring')
                                        <span class="badge bg-warning">Hampir Habis</span>
                                    @else
                                        <span class="badge bg-danger">Kadaluarsa</span>
                                    @endif
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
