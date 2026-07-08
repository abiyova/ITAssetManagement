<x-app-layout>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Lampiran Aset: {{ $asset->asset_code }}</h2>
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

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Upload Lampiran</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('assets.store-attachment', $asset) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Jenis Lampiran <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="invoice">Invoice</option>
                                    <option value="purchase_order">Purchase Order</option>
                                    <option value="warranty_card">Kartu Garansi</option>
                                    <option value="manual_book">Buku Manual</option>
                                    <option value="photo">Foto</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-upload"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Lampiran</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Jenis</th>
                                        <th>Nama File</th>
                                        <th>Ukuran</th>
                                        <th>Tanggal Upload</th>
                                        <th width="100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($asset->attachments as $attachment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                    $typeBadge = match($attachment->type) {
                                                        'invoice' => 'bg-primary',
                                                        'purchase_order' => 'bg-info',
                                                        'warranty_card' => 'bg-warning text-dark',
                                                        'manual_book' => 'bg-success',
                                                        'photo' => 'bg-secondary',
                                                        default => 'bg-secondary',
                                                    };
                                                @endphp
                                                <span class="badge {{ $typeBadge }}">{{ ucfirst(str_replace('_', ' ', $attachment->type)) }}</span>
                                            </td>
                                            <td>
                                                <i class="bi bi-file-earmark me-1"></i>
                                                {{ $attachment->original_name }}
                                            </td>
                                            <td>{{ number_format($attachment->file_size / 1024, 1) }} KB</td>
                                            <td>{{ $attachment->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" class="btn btn-outline-primary" target="_blank" title="Lihat">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" class="btn btn-outline-success" download title="Unduh">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <form action="{{ route('assets.delete-attachment', [$asset, $attachment]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lampiran ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-paperclip fs-1 d-block mb-2"></i>
                                                Belum ada lampiran untuk aset ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
