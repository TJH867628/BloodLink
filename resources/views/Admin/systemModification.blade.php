<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - System Modification</title>
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
            gap: 12px;
            padding: 12px 24px;
            color: var(--text-muted);
            font-weight: 500;
            margin: 4px 16px;
            border-radius: 12px;
            text-decoration: none;
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

        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 5rem;
            }
        }

        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Admin Portal</div>
            <a href="/admin/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Management</a>
            <a href="/admin/medicalFacilitiesManagement" class="nav-link"><i class="fas fa-hospital w-25"></i>Medical Facilities Management</a>
            <a href="/admin/systemModification" class="nav-link active"><i class="fas fa-cogs w-25"></i> System Modification</a>
            <a href="/admin/auditReport" class="nav-link"><i class="fas fa-file-alt w-25"></i> Audit & Reports</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">Admin</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
        <form method="POST" action="{{ route('admin.updateSystemSettings') }}">
        @csrf
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-black mb-0">System Modification</h2>
                <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" type="submit"><i class="fas fa-save me-2"></i> Save Changes</button>
            </div>
            @if($settings['emergency_mode'] ?? 0 == 1)
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Emergency Mode is Enabled!</strong> The system is currently in emergency mode. Donation intervals have been reduced to 2 months.
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="custom-card h-100">
                        <h5 class="fw-bold mb-4 text-danger"><i class="fas fa-heart me-2"></i> Donation Protocols</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Minimum Donation Interval (Months)</label>
                            <input type="number" class="form-control" name="donation_interval_months" value="{{ $settings['donation_interval_months'] }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Min Hemoglobin Level (g/dL)</label>
                            <input type="number" step="0.1" name="min_hemoglobin" class="form-control" value="{{ $settings['min_hemoglobin'] }}">
                        </div>
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="emergency_mode" role="switch" id="emergencyOverride" {{ ($settings['emergency_mode'] ?? 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-danger" for="emergencyOverride">Emergency Shortage Mode</label>
                            <div class="small text-muted">Reduces interval to 2 months and broadcasts alerts.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="custom-card h-100">
                        <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-database me-2"></i> Inventory Thresholds</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Critical Low Trigger (%)</label>
                            <input type="number" class="form-control" name="inventory_critical_pct" value="{{ $settings['inventory_critical_pct'] ?? 15 }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Warning Low Trigger (%)</label>
                            <input type="number" class="form-control" name="inventory_warning_pct" value="{{ $settings['inventory_warning_pct'] ?? 30 }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Optimal Target (%)</label>
                            <input type="number" class="form-control" name="inventory_optimal_pct" value="{{ $settings['inventory_optimal_pct'] ?? 80 }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>