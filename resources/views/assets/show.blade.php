<x-app-layout>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Detail Aset: {{ $asset->asset_code }}</h2>
            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Aset</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Kode Aset</label>
                                <div class="fw-bold fs-5"><code>{{ $asset->asset_code }}</code></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Nama Aset</label>
                                <div class="fw-bold fs-5">{{ $asset->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Kategori</label>
                                <div>{{ $asset->category->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Merek</label>
                                <div>{{ $asset->brand->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Vendor</label>
                                <div>{{ $asset->vendor->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Departemen</label>
                                <div>{{ $asset->department->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Lokasi</label>
                                <div>{{ $asset->location->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Pengguna</label>
                                <div>{{ $asset->assignedUser->name ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Nomor Seri</label>
                                <div>{{ $asset->serial_number ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Model</label>
                                <div>{{ $asset->model ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Tanggal Pembelian</label>
                                <div>{{ $asset->purchase_date ? $asset->purchase_date->format('d/m/Y') : '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Harga Pembelian</label>
                                <div>Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Tanggal Akhir Garansi</label>
                                <div>{{ $asset->warranty_end_date ? $asset->warranty_end_date->format('d/m/Y') : '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">Barcode</label>
                                <div><code>{{ $asset->barcode ?? '-' }}</code></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted mb-0">QR Code</label>
                                <div><code>{{ $asset->qr_code ?? '-' }}</code></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted mb-0">Deskripsi</label>
                                <div>{{ $asset->description ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Foto & Status</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($asset->photo)
                            <img src="{{ asset('storage/' . $asset->photo) }}" alt="Foto Aset" class="img-fluid rounded mb-3" style="max-height: 250px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 250px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif

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
                        <div class="mb-3">
                            <label class="form-label text-muted mb-1">Status</label>
                            <div><span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($asset->status) }}</span></div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label text-muted mb-1">Dibuat</label>
                            <div class="small">{{ $asset->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div>
                            <label class="form-label text-muted mb-1">Diupdate</label>
                            <div class="small">{{ $asset->updated_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Aksi</h5>
                    </div>
                    <div class="card-body d-grid gap-2">
                        <a href="{{ route('assets.edit', $asset) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('assets.timeline', $asset) }}" class="btn btn-info">
                            <i class="bi bi-clock-history"></i> Timeline
                        </a>
                        <a href="{{ route('assets.attachments', $asset) }}" class="btn btn-secondary">
                            <i class="bi bi-paperclip"></i> Lampiran
                        </a>
                        <a href="{{ route('assets.print', $asset) }}" class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-printer"></i> Cetak
                        </a>
                        <form action="{{ route('assets.destroy', $asset) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
