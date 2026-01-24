<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Admin Dashboard</title>
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
            transition: all 0.2s;
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

        .stat-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 1.5rem;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
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
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/admin/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/userManagement">User Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/medicalFacilitiesManagement">Hospital Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/systemModification">System Modification</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/auditReport">Audit & Reports</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Admin Portal</div>
            <a href="/admin/dashboard" class="nav-link active"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Management</a>
            <a href="/admin/medicalFacilitiesManagement" class="nav-link"><i class="fas fa-hospital w-25"></i>Medical Facilities Management</a>
            <a href="/admin/systemModification" class="nav-link"><i class="fas fa-cogs w-25"></i> System Modification</a>
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
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Admin Dashboard</h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">System Admin</div>
                    <div class="text-label text-primary">Admin</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>   
        @if($emergencyMode == 1)
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <div>
                <strong>Emergency Mode is Enabled!</strong> The system is currently in emergency mode. Donation intervals have been reduced to 2 months.
            </div>
        </div>
        @endif
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="text-label text-primary">Total Users</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0">{{ $totalUsers }}</h2>
                        <i class="fas fa-users text-primary opacity-25 fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="text-label text-success">Hospitals/Clinic</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0">{{ $totalMedicalFacilities }}</h2>
                        <i class="fas fa-hospital text-success opacity-25 fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="text-label text-danger">Total Inventory</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0">{{ $currentBloodStock }} Bags</h2>
                        <i class="fas fa-burn text-danger opacity-25 fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 rounded-4">
            <h5 class="fw-bold mb-4">Recent System Activities</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="small text-muted fw-bold">Time</th>
                            <th class="small text-muted fw-bold">User</th>
                            <th class="small text-muted fw-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td class="small text-muted">
                                {{ \Carbon\Carbon::parse($log->timestamp)->format('h:i A') }}
                            </td>

                            <td>
                                <div class="fw-bold">{{ $log->user->name }}</div>
                                <div class="text-muted small">
                                    ID {{ $log->user_id }} • 
                                    <span class="
                                        @if($log->user->role == 'ADMIN') text-danger
                                        @elseif($log->user->role == 'HOSPITAL') text-primary
                                        @elseif($log->user->role == 'DONOR') text-success
                                        @else text-secondary
                                        @endif
                                    ">
                                        {{ $log->user->role }}
                                    </span>
                                </div>
                            </td>

                            <td class="fw-semibold">
                                {{ $log->action }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                No activity yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>