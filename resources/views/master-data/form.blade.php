@props(['title', 'fields', 'storeUrl', 'method' => 'POST', 'updateUrl' => null])

<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">{{ $title }}</h4>
        <a href="{{ Str::before($storeUrl, '/create') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $method === 'PUT' ? $updateUrl : $storeUrl }}">
                @csrf
                @if($method === 'PUT') @method('PUT') @endif
                <div class="row g-3">
                    @foreach($fields as $field)
                        <div class="col-md-{{ $field['col'] ?? 6 }}">
                            <label class="form-label">
                                {{ $field['label'] }}
                                @if($field['required'] ?? false) <span class="text-danger">*</span> @endif
                            </label>
                            @if(($field['type'] ?? 'text') === 'select')
                                <select name="{{ $field['name'] }}" class="form-select @error($field['name']) is-invalid @enderror" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                    <option value="">-- Pilih {{ $field['label'] }} --</option>
                                    @foreach($field['options'] as $key => $value)
                                        <option value="{{ $key }}" {{ old($field['name'], $field['value'] ?? '') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            @elseif(($field['type'] ?? 'text') === 'textarea')
                                <textarea name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" rows="3" {{ ($field['required'] ?? false) ? 'required' : '' }}>{{ old($field['name'], $field['value'] ?? '') }}</textarea>
                            @elseif(($field['type'] ?? 'text') === 'date')
                                <input type="date" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name'], $field['value'] ?? '') }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                            @elseif(($field['type'] ?? 'text') === 'number')
                                <input type="number" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name'], $field['value'] ?? '') }}" step="{{ $field['step'] ?? '1' }}" min="{{ $field['min'] ?? '0' }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                            @elseif(($field['type'] ?? 'text') === 'file')
                                <input type="file" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" accept="{{ $field['accept'] ?? '*' }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                            @else
                                <input type="text" name="{{ $field['name'] }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name'], $field['value'] ?? '') }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                            @endif
                            @error($field['name']) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <a href="{{ Str::before($storeUrl, '/create') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
