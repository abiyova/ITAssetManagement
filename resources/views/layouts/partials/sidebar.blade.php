<div class="sidebar border-end shadow-sm" id="sidebar">
    <div class="sidebar-header p-3 border-bottom">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
            <i class="bi bi-box-seam-fill text-primary fs-3 me-2"></i>
            <span class="fs-5 fw-bold text-dark sidebar-text">AssetInsight</span>
        </a>
    </div>

    <div class="sidebar-menu p-3">
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2-fill me-2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            @hasanyrole(['super-admin', 'it-staff'])
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people-fill me-2"></i>
                    <span class="sidebar-text">User Management</span>
                </a>
            </li>
            @endhasrole

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}" href="{{ route('assets.index') }}">
                    <i class="bi bi-pc-display me-2"></i>
                    <span class="sidebar-text">Asset</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('assignments.*') ? 'active' : '' }}" href="{{ route('assignments.index') }}">
                    <i class="bi bi-person-check me-2"></i>
                    <span class="sidebar-text">Peminjaman</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('transfers.*') ? 'active' : '' }}" href="{{ route('transfers.index') }}">
                    <i class="bi bi-arrow-left-right me-2"></i>
                    <span class="sidebar-text">Perpindahan</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('maintenances.*') ? 'active' : '' }}" href="{{ route('maintenances.index') }}">
                    <i class="bi bi-tools me-2"></i>
                    <span class="sidebar-text">Maintenance</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('warranty.*') ? 'active' : '' }}" href="{{ route('warranty.index') }}">
                    <i class="bi bi-shield-check me-2"></i>
                    <span class="sidebar-text">Garansi</span>
                </a>
            </li>

            <li class="nav-divider my-3"></li>

            <li class="nav-item mb-1">
                <a class="nav-link" href="#masterDataMenu" data-bs-toggle="collapse">
                    <i class="bi bi-database-fill me-2"></i>
                    <span class="sidebar-text">Master Data</span>
                    <i class="bi bi-chevron-down ms-auto sidebar-text"></i>
                </a>
                <div class="collapse {{ request()->routeIs('categories.*','brands.*','vendors.*','departments.*','locations.*','employees.*') ? 'show' : '' }}" id="masterDataMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="bi bi-tag me-2"></i><span class="sidebar-text">Kategori</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}" href="{{ route('brands.index') }}">
                                <i class="bi bi-badge-tm me-2"></i><span class="sidebar-text">Merek</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vendors.*') ? 'active' : '' }}" href="{{ route('vendors.index') }}">
                                <i class="bi bi-shop me-2"></i><span class="sidebar-text">Vendor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                                <i class="bi bi-building me-2"></i><span class="sidebar-text">Departemen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}" href="{{ route('locations.index') }}">
                                <i class="bi bi-geo-alt me-2"></i><span class="sidebar-text">Lokasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                                <i class="bi bi-person-badge me-2"></i><span class="sidebar-text">Karyawan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-divider my-3"></li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i>
                    <span class="sidebar-text">Laporan</span>
                </a>
            </li>

            @hasanyrole(['super-admin', 'auditor'])
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('audit-logs.*') ? 'active' : '' }}" href="{{ route('audit-logs.index') }}">
                    <i class="bi bi-clock-history me-2"></i>
                    <span class="sidebar-text">Audit Log</span>
                </a>
            </li>
            @endhasrole
        </ul>
    </div>
</div>
