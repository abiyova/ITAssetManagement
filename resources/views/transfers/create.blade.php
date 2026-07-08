<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Tambah Perpindahan</h4>
        <a href="{{ route('transfers.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('transfers.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Aset <span class="text-danger">*</span></label>
                        <select name="asset_id" class="form-select @error('asset_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Aset --</option>
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->asset_code }} - {{ $asset->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('asset_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Perpindahan <span class="text-danger">*</span></label>
                        <input type="date" name="transfer_date" class="form-control @error('transfer_date') is-invalid @enderror" value="{{ old('transfer_date', date('Y-m-d')) }}" required>
                        @error('transfer_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dari Lokasi <span class="text-danger">*</span></label>
                        <select name="from_location_id" class="form-select @error('from_location_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lokasi Asal --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('from_location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('from_location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ke Lokasi <span class="text-danger">*</span></label>
                        <select name="to_location_id" class="form-select @error('to_location_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lokasi Tujuan --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('to_location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('to_location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dari Departemen</label>
                        <select name="from_department_id" class="form-select">
                            <option value="">-- Pilih Departemen Asal --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('from_department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ke Departemen</label>
                        <select name="to_department_id" class="form-select">
                            <option value="">-- Pilih Departemen Tujuan --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('to_department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alasan</label>
                        <textarea name="reason" class="form-control" rows="3" placeholder="Alasan perpindahan...">{{ old('reason') }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <a href="{{ route('transfers.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
