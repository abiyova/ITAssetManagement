@props(['title', 'items', 'columns', 'createUrl', 'fields', 'searchPlaceholder' => 'Cari...'])

<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">{{ $title }}</h4>
        <a href="{{ $createUrl }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="{{ $searchPlaceholder }}" value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">#</th>
                            @foreach($columns as $col)
                                <th>{{ $col }}</th>
                            @endforeach
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="ps-3">{{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}</td>
                                @foreach($fields as $field)
                                    <td>{!! $item->{$field['key']} ?? '-' !!}</td>
                                @endforeach
                                <td class="text-end pe-3">
                                    @if(isset($field['edit_route']))
                                        <a href="{{ route($field['edit_route'], $item) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="{{ count($columns) + 2 }}" class="text-center py-4 text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $items->links() }}
        </div>
    </div>
</x-app-layout>
