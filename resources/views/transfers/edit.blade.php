<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Edit Perpindahan</h4>
        <a href="{{ route('transfers.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('transfers.update', $transfer) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Aset</label>
                        <input type="text" class="form-control" value="{{ $transfer->asset->asset_code ?? '' }} - {{ $transfer->asset->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Perpindahan</label>
                        <input type="text" class="form-control" value="{{ $transfer->transfer_date?->format('d/m/Y') ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dari Lokasi</label>
                        <input type="text" class="form-control" value="{{ $transfer->fromLocation->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ke Lokasi</label>
                        <input type="text" class="form-control" value="{{ $transfer->toLocation->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $transfer->status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="approved" {{ old('status', $transfer->status) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ old('status', $transfer->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="completed" {{ old('status', $transfer->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alasan</label>
                        <textarea name="reason" class="form-control" rows="3">{{ old('reason', $transfer->reason) }}</textarea>
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
