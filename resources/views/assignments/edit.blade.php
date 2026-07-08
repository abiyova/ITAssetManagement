<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Edit Peminjaman</h4>
        <a href="{{ route('assignments.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('assignments.update', $assignment) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Aset</label>
                        <input type="text" class="form-control" value="{{ $assignment->asset->asset_code ?? '' }} - {{ $assignment->asset->name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peminjam <span class="text-danger">*</span></label>
                        <select name="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to', $assignment->assigned_to) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="text" class="form-control" value="{{ $assignment->assign_date?->format('d/m/Y') ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ $assignment->status == 'active' ? 'Aktif' : 'Dikembalikan' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $assignment->notes) }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <a href="{{ route('assignments.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
