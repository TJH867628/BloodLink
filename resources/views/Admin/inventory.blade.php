<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Inventory & Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #DC2626;
            --bg-slate: #F8FAFC;
            --text-dark: #1E293B;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-slate);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid #E2E8F0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .brand-section {
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            background-color: var(--primary-red);
            color: white;
            padding: 8px;
            border-radius: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            margin: 4px 16px;
            border-radius: 12px;
            color: var(--text-muted);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-icon {
            width: 32px;
            /* FIXED WIDTH */
            width: 32px;
            /* FIXED WIDTH */
            display: flex;
            justify-content: center;
            font-size: 1rem;
            margin-right: 12px;
            color: inherit;
        }

        .nav-link:hover {
            background-color: #F1F5F9;
            color: var(--text-dark);
        }

        .nav-link.active {
            background-color: #FEF2F2;
            color: var(--primary-red);
            font-weight: 700;
            border-right: 4px solid var(--primary-red);
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 5rem;
            }

            .mobile-nav {
                display: block !important;
            }
        }

        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-optimal {
            background-color: #ECFDF5;
            color: #059669;
        }

        .badge-low {
            background-color: #FFFBEB;
            color: #D97706;
        }

        .badge-critical {
            background-color: #FEF2F2;
            color: #DC2626;
        }

        .report-card {
            background-color: #1E293B;
            color: white;
            border-radius: 24px;
            padding: 2rem;
        }

        .report-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 100%;
            text-align: left;
            padding: 1rem;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }

        .report-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.05em;
        }

        /* Logout Styles */
        .logout-link {
            text-decoration: none;
            color: inherit;
        }

        .logout-item {
            transition: all 0.25s ease;
        }

        .icon-box {
            background: #f1f5f9;
            padding: 10px;
            border-radius: 10px;
            color: #64748b;
            transition: all 0.25s ease;
        }

        .logout-text {
            color: #dc2626;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .logout-item:hover {
            background: #fff1f2;
        }

        .logout-item:hover .icon-box {
            background: #fee2e2;
            color: #dc2626;
            transform: translateX(4px);
        }

        .logout-item:hover .logout-text {
            color: #b91c1c;
            text-decoration: underline;
        }

        /* Form inputs in modals */
        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px 16px;
            border: 2px solid #F1F5F9;
            background-color: #F8FAFC;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #FECACA;
            box-shadow: none;
            background-color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <a href="/admin/dashboard" class="nav-link active"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
                <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Management</a>
                <a href="/admin/medicalFacilitiesManagement" class="nav-link"><i class="fas fa-hospital w-25"></i>Medical Facilities Management</a>
                <a href="/admin/inventory" class="nav-link"><i class="fas fa-hospital w-25"></i>Blood Inventories</a>
                <a href="/admin/systemModification" class="nav-link"><i class="fas fa-cogs w-25"></i> System Modification</a>
                <a href="/admin/auditReport" class="nav-link"><i class="fas fa-file-alt w-25"></i> Audit & Reports</a>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span
                class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label"
                style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Hospital Portal
            </div>
            <a href="/admin/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Management</a>
            <a href="/admin/medicalFacilitiesManagement" class="nav-link"><i class="fas fa-hospital w-25"></i>Medical
                Facilities Management</a>
            <a href="/admin/inventory" class="nav-link active"><i class="fas fa-hospital w-25"></i>Blood Inventories</a>
            <a href="/admin/systemModification" class="nav-link"><i class="fas fa-cogs w-25"></i> System
                Modification</a>
            <a href="/admin/auditReport" class="nav-link"><i class="fas fa-file-alt w-25"></i> Audit & Reports</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
         <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Inventory & Reports</h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="/admin/notification" class="btn border-0 position-relative text-secondary">
                    <i class="fas fa-bell fa-lg"></i>
                    @if($hasUnreadNotifications)
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    @endif
                </a>
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">{{ $user->name }}</div>
                        <div class="text-label text-primary" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">{{ $user->role }}</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" class="rounded-3 border" width="40"
                        height="40" alt="Avatar">
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" class="rounded-3 border" width="40"
                    height="40" alt="Avatar">
            </div>
        </header>

        <div class="row g-4">
            <!-- Inventory Table Section -->
            <div class="col-xl-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Current Overall Stock</h4>
                    <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#addBatchModal"><i class="fas fa-plus me-2"></i> Add Batch</button>
                </div>
                <div class="row g-3 mb-5">
                    @foreach($bloodTypeSummary as $type)
                        @php
                            $critical = (int) $settings['inventory_critical_pct'];
                            $warning = (int) $settings['inventory_warning_pct'];
                            $optimal = (int) $settings['inventory_optimal_pct'];
                            $overall_target = (int) $settings['overall_target_units'];
                        @endphp
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="p-4 rounded-4 shadow-sm text-center 
                            @if($type->quantity <= $overall_target * ($critical / 100)) bg-danger text-white
                            @elseif($type->status <= $overall_target * ($warning / 100)) bg-warning
                            @else bg-success text-white
                            @endif
                        ">
                                <h4 class="fw-black">{{ $type->blood_type }}</h4>
                                <div class="fs-1 fw-bold">{{ $type->total }}</div>
                                <div class="small">Total Units</div>
                                <span class="badge bg-dark mt-2">{{ $type->status }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <h4 class="fw-bold mb-0">Current Stock For Each Medical Facilities</h4><br>
                <form method="GET" action="{{ route('admin.inventory') }}" class="row g-3 mb-4">

                    <div class="col-md-4">
                        <select name="facility" class="form-select">
                            <option value="">All Facilities</option>
                            @foreach($facilities as $f)
                                <option value="{{ $f->id }}" {{ request('facility') == $f->id ? 'selected' : '' }}>
                                    {{ $f->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="blood_type" class="form-select">
                            <option value="">All Blood Types</option>
                            @foreach($bloodTypes as $bt)
                                <option value="{{ $bt }}" {{ request('blood_type') == $bt ? 'selected' : '' }}>
                                    {{ $bt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="OPTIMAL" {{ request('status') == 'OPTIMAL' ? 'selected' : '' }}>Optimal
                            </option>
                            <option value="LOW_STOCK" {{ request('status') == 'LOW_STOCK' ? 'selected' : '' }}>Low Stock
                            </option>
                            <option value="CRITICAL" {{ request('status') == 'CRITICAL' ? 'selected' : '' }}>Critical
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-danger w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>

                </form>
                <div class="custom-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Medical Facilities
                                    </th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Type</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Quantity</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blood_inventories as $inventory)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold">
                                            {{ $inventory->medicalFacility->name ?? 'Unknown Facility' }}
                                            <div class="text-muted small">
                                                ID: {{ $inventory->medical_facilities_id }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 fw-black fs-5">{{ $inventory->blood_type }}</td>
                                        <td class="px-4 py-3 fw-bold">{{ $inventory->quantity }} Units</td>
                                        @if($inventory->status == 'OPTIMAL')
                                            <td class="px-4 py-3"><span class="status-badge badge-optimal">Optimal</span></td>
                                        @elseif($inventory->status == 'LOW_STOCK')
                                            <td class="px-4 py-3"><span class="status-badge badge-low">Low Stock</span></td>
                                        @elseif($inventory->status == 'CRITICAL')
                                            <td class="px-4 py-3"><span class="status-badge badge-critical">Critical</span></td>
                                        @else
                                            <td class="px-4 py-3"><span class="status-badge badge-critical">Critical</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                                @if($blood_inventories->isEmpty())
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 text-center text-muted">No inventory data
                                            available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>