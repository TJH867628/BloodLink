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
                    <li class="nav-item"><a class="nav-link" href="/hospital/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospital_inventory.html">Inventory & Reports</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/hospital/donationManagement">Donation Management</a></li>
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
            <a href="/hospital/inventory" class="nav-link"><i class="fas fa-box-open w-25"></i> Inventory & Reports</a>
            <a href="/hospital/donationManagement" class="nav-link active"><i class="fas fa-user-nurse w-25"></i> Donation Mgmt</a>
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

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Donation Management</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Process today's donor queue and record clinical results.</p>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative d-none d-md-block" style="width: 250px;">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                    <input type="text" class="form-control rounded-pill ps-5" placeholder="Search donor...">
                </div>
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
                    <!-- Updated Button to Trigger Modal -->
                    <button class="btn btn-link text-danger text-decoration-none fw-bold text-uppercase w-100 mt-3" style="font-size: 0.75rem; letter-spacing: 0.1em;" data-bs-toggle="modal" data-bs-target="#historyModal">View Full History</button>
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

    <!-- Full History Modal (New Addition) -->
    <div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Donation History Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Simple Filters -->
                    <div class="d-flex gap-2 mb-3">
                        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search Donor ID">
                        <select class="form-select form-select-sm w-auto">
                            <option>All Results</option>
                            <option>Successful</option>
                            <option>Deferred</option>
                        </select>
                        <button class="btn btn-dark btn-sm rounded-pill px-3 fw-bold">Filter</button>
                    </div>

                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th class="small fw-bold text-muted text-uppercase ps-3">Date</th>
                                    <th class="small fw-bold text-muted text-uppercase">Donor</th>
                                    <th class="small fw-bold text-muted text-uppercase">Type</th>
                                    <th class="small fw-bold text-muted text-uppercase">Vitals (Hb/BP)</th>
                                    <th class="small fw-bold text-muted text-uppercase text-end pe-3">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-29</td>
                                    <td>
                                        <div class="fw-bold small">Michael Chen</div>
                                        <div class="small text-muted">D-105</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">O+</span></td>
                                    <td class="small">14.2 / 110/70</td>
                                    <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Successful</span></td>
                                </tr>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-29</td>
                                    <td>
                                        <div class="fw-bold small">Michael Chen</div>
                                        <div class="small text-muted">D-105</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">O+</span></td>
                                    <td class="small">14.2 / 110/70</td>
                                    <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Successful</span></td>
                                </tr>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-29</td>
                                    <td>
                                        <div class="fw-bold small">Sarah Lee</div>
                                        <div class="small text-muted">D-109</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">A-</span></td>
                                    <td class="small">11.0 / 120/80</td>
                                    <td class="text-end pe-3"><span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Deferred</span></td>
                                </tr>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-28</td>
                                    <td>
                                        <div class="fw-bold small">James Wong</div>
                                        <div class="small text-muted">D-112</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">B+</span></td>
                                    <td class="small">13.8 / 115/75</td>
                                    <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Successful</span></td>
                                </tr>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-27</td>
                                    <td>
                                        <div class="fw-bold small">Priya M.</div>
                                        <div class="small text-muted">D-115</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">AB+</span></td>
                                    <td class="small">12.9 / 118/72</td>
                                    <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Successful</span></td>
                                </tr>
                                <tr>
                                    <td class="small text-muted ps-3">2025-12-25</td>
                                    <td>
                                        <div class="fw-bold small">Ahmad Z.</div>
                                        <div class="small text-muted">D-120</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border">O-</span></td>
                                    <td class="small">15.1 / 122/81</td>
                                    <td class="text-end pe-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Successful</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill fw-bold px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-secondary rounded-pill fw-bold px-4"><i class="fas fa-print me-2"></i> Print Log</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>