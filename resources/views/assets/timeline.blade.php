<x-app-layout>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Timeline Aset: {{ $asset->asset_code }}</h2>
            <a href="{{ route('assets.show', $asset) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Aset</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if($asset->photo)
                                <img src="{{ asset('storage/' . $asset->photo) }}" alt="Foto Aset" class="img-fluid rounded" style="max-height: 150px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="bi bi-image text-muted fs-1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Kode Aset</small>
                            <div class="fw-bold"><code>{{ $asset->asset_code }}</code></div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Nama</small>
                            <div class="fw-bold">{{ $asset->name }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Kategori</small>
                            <div>{{ $asset->category->name ?? '-' }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Lokasi</small>
                            <div>{{ $asset->location->name ?? '-' }}</div>
                        </div>
                        <div>
                            @php
                                $badgeClass = match($asset->status) {
                                    'draft' => 'bg-secondary',
                                    'available' => 'bg-success',
                                    'assigned' => 'bg-info',
                                    'maintenance' => 'bg-warning text-dark',
                                    'damaged' => 'bg-danger',
                                    'lost' => 'bg-dark',
                                    'retired' => 'bg-secondary',
                                    'disposed' => 'bg-dark',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <small class="text-muted">Status</small>
                            <div><span class="badge {{ $badgeClass }}">{{ ucfirst($asset->status) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Riwayat Aktivitas</h5>
                    </div>
                    <div class="card-body">
                        @forelse($asset->timelines as $item)
                            <div class="d-flex mb-4 {{ !$loop->last ? 'border-bottom pb-4' : '' }}">
                                <div class="flex-shrink-0 me-3">
                                    @php
                                        $iconClass = match($item->action) {
                                            'created' => 'bi-plus-circle text-success',
                                            'updated' => 'bi-pencil-square text-warning',
                                            'status_changed' => 'bi-arrow-repeat text-info',
                                            'assigned' => 'bi-person-check text-primary',
                                            'unassigned' => 'bi-person-dash text-secondary',
                                            'location_changed' => 'bi-geo-alt text-danger',
                                            'attachment_added' => 'bi-paperclip text-dark',
                                            'attachment_deleted' => 'bi-trash text-danger',
                                            default => 'bi-circle text-muted',
                                        };
                                    @endphp
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi {{ $iconClass }}"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ ucfirst(str_replace('_', ' ', $item->action)) }}</h6>
                                            <p class="mb-1 text-muted">{{ $item->description }}</p>
                                            <small class="text-muted">
                                                <i class="bi bi-person"></i> {{ $item->user->name ?? 'Sistem' }}
                                            </small>
                                        </div>
                                        <small class="text-muted text-nowrap ms-3">
                                            <i class="bi bi-clock"></i> {{ $item->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-clock-history fs-1 d-block mb-2"></i>
                                Belum ada riwayat aktivitas untuk aset ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
