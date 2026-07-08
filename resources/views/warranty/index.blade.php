<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Garansi Aset</h4>
    </div>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $filter == 'active' ? 'active' : '' }}" href="{{ route('warranty.index', ['filter' => 'active']) }}">
                Aktif <span class="badge bg-success ms-1">{{ $counts['active'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $filter == 'expiring' ? 'active' : '' }}" href="{{ route('warranty.index', ['filter' => 'expiring']) }}">
                Hampir Habis <span class="badge bg-warning ms-1">{{ $counts['expiring'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $filter == 'expired' ? 'active' : '' }}" href="{{ route('warranty.index', ['filter' => 'expired']) }}">
                Kadaluarsa <span class="badge bg-danger ms-1">{{ $counts['expired'] }}</span>
            </a>
        </li>
    </ul>

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
                            <th>Status Garansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            @php
                                $warrantyEnd = $asset->warranty_end_date;
                                $now = now();
                                if ($warrantyEnd && $warrantyEnd->lt($now)) {
                                    $warrantyStatus = 'expired';
                                } elseif ($warrantyEnd && $warrantyEnd->lte($now->copy()->addDays(30))) {
                                    $warrantyStatus = 'expiring';
                                } else {
                                    $warrantyStatus = 'active';
                                }
                            @endphp
                            <tr>
                                <td class="ps-3">{{ ($assets->currentPage() - 1) * $assets->perPage() + $loop->iteration }}</td>
                                <td><code>{{ $asset->asset_code }}</code></td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->category->name ?? '-' }}</td>
                                <td>{{ $asset->brand->name ?? '-' }}</td>
                                <td>{{ $asset->department->name ?? '-' }}</td>
                                <td>{{ $warrantyEnd?->format('d/m/Y') ?? '-' }}</td>
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
                            <tr><td colspan="8" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $assets->links() }}
        </div>
    </div>
</x-app-layout>
