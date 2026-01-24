<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Hospital Dashboard</title>
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

        /* Sidebar */
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
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
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

        /* Dashboard Cards */
        .stat-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .stock-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 1rem;
        }

        .blood-type-card {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 1rem;
            text-align: center;
            transition: all 0.2s;
            cursor: default;
        }

        .blood-type-card:hover {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-color: #CBD5E1;
        }

        .progress-thin {
            height: 6px;
            border-radius: 3px;
            background-color: #F1F5F9;
            margin-top: 10px;
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
                <div class="brand-icon"><i class="fas fa-droplet"></i></div>
                <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/medical_facilities/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/inventory">Inventory & Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/donationManagement">Donation Management</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div>
            <span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Hospital Portal</div>
            <a href="/medical_facilities/dashboard" class="nav-link active"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/medical_facilities/inventory" class="nav-link"><span class="nav-icon"><i class="fas fa-box-open w-25"></i></span> Inventory & Reports</a>
            <a href="/medical_facilities/donationManagement" class="nav-link"><span class="nav-icon"><i class="fas fa-user-nurse w-25"></i></span> Donation Management</a>
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
                <h2 class="fw-black mb-0">Dashboard</h2>
            </div>
            <div class="d-flex align-items-center gap-4">
                <button class="btn border-0 position-relative text-secondary">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">Hospital Staff</div>
                        <div class="text-label text-success">Staff</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Hospital" class="rounded-3 border" width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label">Total Inventory</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0">150</h2>
                        <span class="text-muted small fw-bold">Units</span>
                    </div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-danger" style="width: 65%"></div>
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.75rem;">65% Storage Capacity</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label text-danger">Urgent Requests</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-danger">03</h2>
                        <span class="badge bg-danger-subtle text-danger">Action Req.</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">Pending broadcasts to donors</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card border-warning">
                    <div class="text-label text-warning">Expiring Soon</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-warning">05</h2>
                        <span class="text-muted small fw-bold">Units</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">Expire within 48 hours</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label text-primary">Today's Queue</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-primary">12</h2>
                        <span class="text-muted small fw-bold">Donors</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">8 Processed • 4 Pending</div>
                </div>
            </div>
        </div>

        <!-- Real-time Stock -->
        <div class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius: 24px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0"><i class="fas fa-heartbeat text-danger me-2"></i> Real-time Stock Levels</h4>
            </div>
            <div class="stock-grid">
                <!-- O+ -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">O+</div>
                    <div class="fs-4 fw-black text-dark">45</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-success" style="width: 80%"></div>
                    </div>
                </div>
                <!-- O- -->
                <div class="blood-type-card bg-danger-subtle border-danger">
                    <div class="text-label text-danger mb-1">O-</div>
                    <div class="fs-4 fw-black text-danger">04</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-danger" style="width: 15%"></div>
                    </div>
                </div>
                <!-- A+ -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">A+</div>
                    <div class="fs-4 fw-black text-dark">32</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                </div>
                <!-- A- -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">A-</div>
                    <div class="fs-4 fw-black text-dark">12</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-warning" style="width: 40%"></div>
                    </div>
                </div>
                <!-- B+ -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">B+</div>
                    <div class="fs-4 fw-black text-dark">28</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-success" style="width: 70%"></div>
                    </div>
                </div>
                <!-- B- -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">B-</div>
                    <div class="fs-4 fw-black text-dark">08</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-warning" style="width: 30%"></div>
                    </div>
                </div>
                <!-- AB+ -->
                <div class="blood-type-card">
                    <div class="text-label mb-1">AB+</div>
                    <div class="fs-4 fw-black text-dark">15</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-success" style="width: 50%"></div>
                    </div>
                </div>
                <!-- AB- -->
                <div class="blood-type-card bg-danger-subtle border-danger">
                    <div class="text-label text-danger mb-1">AB-</div>
                    <div class="fs-4 fw-black text-danger">02</div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-danger" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>