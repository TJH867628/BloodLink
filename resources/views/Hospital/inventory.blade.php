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
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/hospital/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/hospital/inventory">Inventory & Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/hospital/donationManagement">Donation Management</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label" style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Hospital Portal</div>
            <a href="/hospital/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/hospital/inventory" class="nav-link active"><i class="fas fa-box-open w-25"></i> Inventory & Reports</a>
            <a href="/hospital/donationManagement" class="nav-link"><i class="fas fa-user-nurse w-25"></i> Donation Management</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light">
                <div class="bg-light rounded-3 p-2 text-secondary"><i class="fas fa-sign-out-alt"></i></div>
                <div>
                    <div class="fw-bold text-dark small">Dr. Chai Yu Xuan</div>
                    <div class="text-label text-danger" style="cursor: pointer;">Sign Out</div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <!-- Header Section -->
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Inventory & Reports</h2>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                        <i class="fas fa-check-circle me-1"></i> System Operational
                    </span>
                </div>  
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">Hospital Staff</div>
                        <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Verified Staff</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Hospital" class="rounded-3 border" width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <div class="row g-4">
            <!-- Inventory Table Section -->
            <div class="col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">Current Stock Batches</h4>
                    <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm"><i class="fas fa-plus me-2"></i> Add Batch</button>
                </div>

                <div class="custom-card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Type</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Quantity</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Expiry</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                                    <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3 fw-black fs-5">O-</td>
                                    <td class="px-4 py-3 fw-bold">12 Units</td>
                                    <td class="px-4 py-3 text-danger fw-bold">15 Jan 2026</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-critical">Low</span></td>
                                    <td class="px-4 py-3 text-end"><button class="btn btn-light btn-sm"><i class="fas fa-edit text-muted"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 fw-black fs-5">A+</td>
                                    <td class="px-4 py-3 fw-bold">45 Units</td>
                                    <td class="px-4 py-3 text-dark">10 Feb 2026</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-optimal">Optimal</span></td>
                                    <td class="px-4 py-3 text-end"><button class="btn btn-light btn-sm"><i class="fas fa-edit text-muted"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 fw-black fs-5">AB-</td>
                                    <td class="px-4 py-3 fw-bold">03 Units</td>
                                    <td class="px-4 py-3 text-danger fw-bold">05 Jan 2026</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-critical">Critical</span></td>
                                    <td class="px-4 py-3 text-end"><button class="btn btn-light btn-sm"><i class="fas fa-edit text-muted"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 fw-black fs-5">B+</td>
                                    <td class="px-4 py-3 fw-bold">28 Units</td>
                                    <td class="px-4 py-3 text-dark">22 Mar 2026</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-optimal">Optimal</span></td>
                                    <td class="px-4 py-3 text-end"><button class="btn btn-light btn-sm"><i class="fas fa-edit text-muted"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Reports Sidebar Section -->
            <div class="col-xl-4">
                <div class="report-card h-100">
                    <h3 class="fw-bold mb-4">Generate Reports</h3>
                    <p class="text-white-50 mb-4 small">Select a report type below to generate a detailed PDF analysis for administrative review.</p>

                    <div class="vstack gap-3 mb-5">
                        <button class="report-btn">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-file-invoice text-success"></i>
                                <span class="fw-bold small">Inventory Summary</span>
                            </div>
                            <i class="fas fa-download"></i>
                        </button>
                        <button class="report-btn">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-trash-alt text-danger"></i>
                                <span class="fw-bold small">Wastage Analysis</span>
                            </div>
                            <i class="fas fa-download"></i>
                        </button>
                    </div>

                    <div class="border-top border-secondary pt-4">
                        <label class="small fw-bold text-secondary text-uppercase mb-2">Custom Date Range</label>
                        <div class="row g-2">
                            <div class="col-6"><input type="date" class="form-control form-control-sm bg-dark text-white border-secondary"></div>
                            <div class="col-6"><input type="date" class="form-control form-control-sm bg-dark text-white border-secondary"></div>
                        </div>
                        <button class="btn btn-danger w-100 mt-3 fw-bold py-2">Generate Custom PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>