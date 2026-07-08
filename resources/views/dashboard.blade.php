<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Dashboard</h4>
            <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>
        <div>
            <form method="GET" class="d-flex align-items-center gap-2">
                <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                    @for($y = date('Y'); $y >= date('Y') - 3; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Aset</p>
                            <h4 class="fw-bold mb-0">{{ number_format($totalAssets) }}</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-pc-display text-primary fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Tersedia</p>
                            <h4 class="fw-bold mb-0">{{ number_format($availableAssets) }}</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-check-circle text-success fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Dipinjam</p>
                            <h4 class="fw-bold mb-0">{{ number_format($assignedAssets) }}</h4>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-person-check text-info fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Maintenance</p>
                            <h4 class="fw-bold mb-0">{{ number_format($maintenanceAssets) }}</h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-tools text-warning fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Rusak</p>
                            <h4 class="fw-bold mb-0">{{ number_format($damagedAssets) }}</h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-exclamation-triangle text-danger fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-secondary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Hilang</p>
                            <h4 class="fw-bold mb-0">{{ number_format($lostAssets) }}</h4>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-question-circle text-secondary fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Pensiun</p>
                            <h4 class="fw-bold mb-0">{{ number_format($retiredAssets) }}</h4>
                        </div>
                        <div class="bg-dark bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-archive text-dark fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card border-teal h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Nilai Total</p>
                            <h4 class="fw-bold mb-0">Rp {{ number_format($totalValue, 0, ',', '.') }}</h4>
                        </div>
                        <div class="bg-teal bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-cash-stack text-success fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-pie-chart me-2"></i>Aset per Kategori</h6>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-bar-chart me-2"></i>Aset per Departemen</h6>
                </div>
                <div class="card-body">
                    <canvas id="departmentChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-geo-alt me-2"></i>Aset per Lokasi</h6>
                </div>
                <div class="card-body">
                    <canvas id="locationChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-graph-up me-2"></i>Pembelian Bulanan</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-shield-check me-2"></i>Status Garansi</h6>
                </div>
                <div class="card-body">
                    <canvas id="warrantyChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                @forelse($recentActivities as $asset)
                                    <tr>
                                        <td class="ps-3">
                                            <small class="text-muted">{{ $asset->created_at->diffForHumans() }}</small>
                                            <br>
                                            <span class="fw-semibold">{{ $asset->name }}</span>
                                            <br>
                                            <small>{{ $asset->category->name }}</small>
                                        </td>
                                        <td class="pe-3 text-end">
                                            <span class="badge bg-{{ match($asset->status) {
                                                'available' => 'success',
                                                'assigned' => 'info',
                                                'maintenance' => 'warning',
                                                'damaged' => 'danger',
                                                'lost' => 'secondary',
                                                'retired' => 'dark',
                                                default => 'light',
                                            } }}">{{ ucfirst($asset->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="text-center text-muted py-4">Belum ada aktivitas</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const colors = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#0dcaf0', '#6f42c1', '#fd7e14', '#20c997', '#d63384', '#6c757d'];

        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($assetsByCategory->keys()) !!},
                datasets: [{
                    data: {!! json_encode($assetsByCategory->values()) !!},
                    backgroundColor: colors,
                }]
            }
        });

        new Chart(document.getElementById('departmentChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($assetsByDepartment->keys()) !!},
                datasets: [{
                    label: 'Jumlah Aset',
                    data: {!! json_encode($assetsByDepartment->values()) !!},
                    backgroundColor: '#0d6efd',
                }]
            }
        });

        new Chart(document.getElementById('locationChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($assetsByLocation->keys()) !!},
                datasets: [{
                    data: {!! json_encode($assetsByLocation->values()) !!},
                    backgroundColor: colors,
                }]
            }
        });

        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const monthlyData = {!! json_encode($monthlyPurchases) !!};
        const monthlyValues = months.map((_, i) => monthlyData[i + 1] || 0);

        new Chart(document.getElementById('monthlyChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Pembelian',
                    data: monthlyValues,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    fill: true,
                    tension: 0.4,
                }]
            }
        });

        new Chart(document.getElementById('warrantyChart'), {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Hampir Habis', 'Kadaluarsa'],
                datasets: [{
                    data: [{{ $warrantyStatus['active'] }}, {{ $warrantyStatus['expiring'] }}, {{ $warrantyStatus['expired'] }}],
                    backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                }]
            }
        });
    </script>
    @endpush
</x-app-layout>
