<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Blood Logistics</title>
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
            height: 100%;
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

    <!-- Mobile Nav -->
    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/inventory">Inventory & Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/donationManagemen">Donation Management</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="hospital_blood_logistics.html">Blood Logistics</a></li>
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
            <a href="/medical_facilities/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/medical_facilities/inventory" class="nav-link"><i class="fas fa-box-open w-25"></i> Inventory & Reports</a>
            <a href="/medical_facilities/donationManagement" class="nav-link"><i class="fas fa-user-nurse w-25"></i> Donation Management</a>
            <a href="/medical_facilities/bloodtypeManagement" class="nav-link active"><span class="nav-icon"><i class="fas fa-exchange-alt w-25"></i></span> Blood Logistics</a>
            <a href="/medical_facilities/profile" class="nav-link"><i class="fas fa-hospital w-25"></i> Profile</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
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
                <h2 class="fw-black mb-0">Blood Logistics</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Manage donor intake and record blood distribution.</p>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">{{ $user->role }}</div>
                        <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Verified Staff</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Hospital" class="rounded-3 border" width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <div class="row g-4">
            <!-- Left: Walk-in Registration (Input) -->
            <div class="col-xl-8 mx-auto">
                <div class="custom-card p-4 p-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary-subtle text-primary p-3 rounded-circle"><i class="fas fa-user-plus fa-lg"></i></div>
                        <div>
                            <h4 class="fw-bold mb-0">Walk-in Submmission</h4>
                            <p class="text-muted small mb-0">Submit unscheduled donors directly into the record.</p>
                        </div>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Donor Name</label>
                            <input type="text" class="form-control" placeholder="e.g. John Doe">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Blood Pressure</label>
                                <input type="text" class="form-control" placeholder="120/70">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Hemogoblin Level </label>
                                <input type="tel" class="form-control" placeholder="13.0">
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Blood Type</label>
                                <select class="form-select">
                                    <option selected disabled>Select...</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">unit(s)</label>
                                <input type="number" class="form-control" placeholder="400">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Medical Note / Remarks</label>
                            <textarea class="form-control" rows="2" placeholder="Any known conditions, recent travel, or immediate observations..."></textarea>
                        </div>
                        <button type="button" class="btn btn-dark w-100 py-3 rounded-pill fw-bold shadow-sm" onclick="alert('Walk-in donor submmitted to donation record.')">
                            <i class="fas fa-check me-2"></i> Submit walk-in donor
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Log Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="custom-card">
                    <div class="p-4 border-bottom bg-light">
                        <h5 class="fw-bold mb-0">Recent Logistics Activity</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Action</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Blood Bag Id</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Blood Type</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Details</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Donor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 fw-bold text-dark">
                                        <input type="checkbox" class="form-check-input" id="checkBlood">
                                        <label class="form-check-label text-muted fw-bold small text-uppercase" for="checkBlood">
                                            Used unit for Inventory
                                        </label>
                                    </td>
                                    <td class="px-4 text-muted small">BB - 001</td>
                                    <td class="px-4 fw-bold text-dark">A-</td>
                                    <td class="px-4 small text-muted">Emergency Transfusion</td>
                                    <td class="px-4 text-end small fw-bold">Dr. Chai</td>
                                </tr>
                                <tr>
                                    <td class="px-4 fw-bold text-dark">
                                        <input type="checkbox" class="form-check-input" id="checkBlood">
                                        <label class="form-check-label text-muted fw-bold small text-uppercase" for="checkBlood">
                                            Used unit for Inventory
                                        </label>
                                    </td>
                                    <td class="px-4 text-muted small">BB - 002</td>
                                    <td class="px-4 fw-bold text-dark">O-</td>
                                    <td class="px-4 small text-muted">Emergency Transfusion</td>
                                    <td class="px-4 text-end small fw-bold">Dr. Chai</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="p-3 border-top bg-light d-flex justify-content-end">
                            <button class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm">Submit Activity Log</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>