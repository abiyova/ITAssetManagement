<x-app-layout>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Edit Aset: {{ $asset->asset_code }}</h2>
            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

        <form action="{{ route('assets.update', $asset) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Aset</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="asset_code" class="form-label">Kode Aset <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('asset_code') is-invalid @enderror" id="asset_code" name="asset_code" value="{{ old('asset_code', $asset->asset_code) }}" readonly>
                                    <small class="text-muted">Kode aset tidak dapat diubah</small>
                                    @error('asset_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Aset <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $asset->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="brand_id" class="form-label">Merek <span class="text-danger">*</span></label>
                                    <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                                        <option value="">Pilih Merek</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $asset->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="vendor_id" class="form-label">Vendor <span class="text-danger">*</span></label>
                                    <select class="form-select @error('vendor_id') is-invalid @enderror" id="vendor_id" name="vendor_id" required>
                                        <option value="">Pilih Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ old('vendor_id', $asset->vendor_id) == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="department_id" class="form-label">Departemen <span class="text-danger">*</span></label>
                                    <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                                        <option value="">Pilih Departemen</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id', $asset->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="location_id" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                    <select class="form-select @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                        <option value="">Pilih Lokasi</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" {{ old('location_id', $asset->location_id) == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        @foreach(['draft','available','assigned','maintenance','damaged','lost','retired','disposed'] as $status)
                                            <option value="{{ $status }}" {{ old('status', $asset->status) === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="serial_number" class="form-label">Nomor Seri</label>
                                    <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}">
                                    @error('serial_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $asset->model) }}">
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date?->format('Y-m-d')) }}">
                                    @error('purchase_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="purchase_price" class="form-label">Harga Pembelian (Rp)</label>
                                    <input type="number" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $asset->purchase_price) }}" min="0" step="0.01">
                                    @error('purchase_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="warranty_end_date" class="form-label">Tanggal Akhir Garansi</label>
                                    <input type="date" class="form-control @error('warranty_end_date') is-invalid @enderror" id="warranty_end_date" name="warranty_end_date" value="{{ old('warranty_end_date', $asset->warranty_end_date?->format('Y-m-d')) }}">
                                    @error('warranty_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="photo" class="form-label">Foto Aset</label>
                                    @if($asset->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $asset->photo) }}" alt="Foto Aset" class="img-thumbnail" style="max-height: 100px;">
                                            <small class="text-muted d-block">Foto saat ini</small>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $asset->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Aksi</h5>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-check-lg"></i> Perbarui Aset
                            </button>
                            <a href="{{ route('assets.show', $asset) }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Info Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <small class="text-muted">
                                <div>Dibuat: {{ $asset->created_at->format('d/m/Y H:i') }}</div>
                                <div>Diupdate: {{ $asset->updated_at->format('d/m/Y H:i') }}</div>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</x-app-layout>
