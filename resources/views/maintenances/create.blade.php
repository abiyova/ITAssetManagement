<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Tambah Maintenance</h4>
        <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('maintenances.store') }}">
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
                        <label class="form-label">Jenis <span class="text-danger">*</span></label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="preventive" {{ old('type') == 'preventive' ? 'selected' : '' }}>Preventive</option>
                            <option value="corrective" {{ old('type') == 'corrective' ? 'selected' : '' }}>Korektif</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teknisi</label>
                        <select name="technician_id" class="form-select">
                            <option value="">-- Pilih Teknisi --</option>
                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}" {{ old('technician_id') == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Jadwal <span class="text-danger">*</span></label>
                        <input type="date" name="schedule_date" class="form-control @error('schedule_date') is-invalid @enderror" value="{{ old('schedule_date', date('Y-m-d')) }}" required>
                        @error('schedule_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Biaya</label>
                        <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}" min="0" step="1000" placeholder="0">
                        @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Catatan maintenance...">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
