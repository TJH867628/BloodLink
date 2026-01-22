<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Donation Management</title>
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
            width: 32px;              /* FIXED WIDTH */
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

        .badge-eligible {
            background-color: #DBEAFE;
            color: #1D4ED8;
        }

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

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.05em;
        }

                /* Remove default link styles */
                .logout-link {
            text-decoration: none;
            color: inherit;
        }

        /* Hover container */
        .logout-item {
            transition: all 0.25s ease;
        }

        /* Icon box */
        .icon-box {
            background: #f1f5f9;
            padding: 10px;
            border-radius: 10px;
            color: #64748b;
            transition: all 0.25s ease;
        }

        /* Text */
        .logout-text {
            color: #dc2626;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        /* Hover Effects */
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
    <!-- Mobile Nav -->
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

    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label" style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Hospital Portal</div>
            <a href="/hospital/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/hospital/inventory" class="nav-link"><span class="nav-icon"><i class="fas fa-box-open w-25"></i></span> Inventory & Reports</a>
            <a href="/hospital/donationManagement" class="nav-link active"><span class="nav-icon"><i class="fas fa-user-nurse w-25"></i></span> Donation Mgmt</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">Dr. Chai Yu Xuan</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Donation Management</h2>
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
            <!-- Queue Section -->
            <div class="col-lg-8">
                <div class="custom-card h-100">
                    <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Today's Queue</h5>
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold">3 Pending</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Donor</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Scheduled</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Eligibility</th>
                                    <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-danger-subtle text-danger rounded p-1 fw-bold small text-center" style="width: 32px;">A+</div>
                                            <div>
                                                <div class="fw-bold">Nesandra Ann</div>
                                                <div class="small text-muted">ID: D-201</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-muted fw-medium">10:30 AM</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-eligible">Eligible</span></td>
                                    <td class="px-4 py-3 text-end">
                                        <button class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#recordModal">Record Result</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-danger-subtle text-danger rounded p-1 fw-bold small text-center" style="width: 32px;">O+</div>
                                            <div>
                                                <div class="fw-bold">Tan Jing Heng</div>
                                                <div class="small text-muted">ID: D-202</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-muted fw-medium">11:00 AM</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-eligible">Eligible</span></td>
                                    <td class="px-4 py-3 text-end">
                                        <button class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#recordModal">Record Result</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-danger-subtle text-danger rounded p-1 fw-bold small text-center" style="width: 32px;">B-</div>
                                            <div>
                                                <div class="fw-bold">Praveena Nair</div>
                                                <div class="small text-muted">ID: D-203</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-muted fw-medium">11:45 AM</td>
                                    <td class="px-4 py-3"><span class="status-badge badge-eligible">Eligible</span></td>
                                    <td class="px-4 py-3 text-end">
                                        <button class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#recordModal">Record Result</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent History Section -->
            <div class="col-lg-4">
                <div class="custom-card h-100 p-4">
                    <h5 class="fw-bold mb-4">Recent Records</h5>
                    <div class="vstack gap-3">
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-4">
                            <div>
                                <div class="fw-bold small text-dark">Michael Chen</div>
                                <div class="text-muted" style="font-size: 0.7rem;">Yesterday • HB 14.2</div>
                            </div>
                            <span class="badge bg-success text-white border-0">Successful</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-4">
                            <div>
                                <div class="fw-bold small text-dark">Sarah Lee</div>
                                <div class="text-muted" style="font-size: 0.7rem;">Yesterday • HB 11.0</div>
                            </div>
                            <span class="badge bg-warning text-dark border-0">Deferred</span>
                        </div>
                    </div>
                    <button class="btn btn-link text-danger text-decoration-none fw-bold text-uppercase w-100 mt-3" style="font-size: 0.75rem; letter-spacing: 0.1em;">View Full History</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Record Result Modal -->
    <div class="modal fade" id="recordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Record Clinical Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Hemoglobin</label>
                                <input type="text" class="form-control" placeholder="g/dL">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Blood Pressure</label>
                                <input type="text" class="form-control" placeholder="mmHg">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Weight</label>
                            <input type="text" class="form-control" placeholder="kg">
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Final Result</label>
                            <select class="form-select">
                                <option>Successful Donation</option>
                                <option>Deferred (Medical)</option>
                                <option>Deferred (Other)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Clinical Notes</label>
                            <textarea class="form-control" rows="2" placeholder="Any adverse reactions?"></textarea>
                        </div>
                        <button type="button" class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Record & Update Inventory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>