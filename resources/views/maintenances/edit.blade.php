<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Edit Maintenance</h4>
        <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('maintenances.update', $maintenance) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Aset</label>
                        <input type="text" class="form-control" value="{{ $maintenance->asset->asset_code ?? '' }} - {{ $maintenance->asset->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis <span class="text-danger">*</span></label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="preventive" {{ old('type', $maintenance->type) == 'preventive' ? 'selected' : '' }}>Preventive</option>
                            <option value="corrective" {{ old('type', $maintenance->type) == 'corrective' ? 'selected' : '' }}>Korektif</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teknisi</label>
                        <select name="technician_id" class="form-select">
                            <option value="">-- Pilih Teknisi --</option>
                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}" {{ old('technician_id', $maintenance->technician_id) == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="scheduled" {{ old('status', $maintenance->status) == 'scheduled' ? 'selected' : '' }}>Dijadwalkan</option>
                            <option value="in_progress" {{ old('status', $maintenance->status) == 'in_progress' ? 'selected' : '' }}>Berlangsung</option>
                            <option value="completed" {{ old('status', $maintenance->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ old('status', $maintenance->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Jadwal <span class="text-danger">*</span></label>
                        <input type="date" name="schedule_date" class="form-control @error('schedule_date') is-invalid @enderror" value="{{ old('schedule_date', $maintenance->schedule_date?->format('Y-m-d')) }}" required>
                        @error('schedule_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $maintenance->start_date?->format('Y-m-d')) }}">
                        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $maintenance->end_date?->format('Y-m-d')) }}">
                        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Biaya</label>
                        <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $maintenance->cost) }}" min="0" step="1000">
                        @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $maintenance->notes) }}</textarea>
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
