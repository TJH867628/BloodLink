<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Find Events</title>
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
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
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
            transition: transform 0.2s;
            overflow: hidden;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #D1FAE5;
            color: #047857;
        }

        .btn-primary-custom {
            background-color: var(--primary-red);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: 700;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #B91C1C;
            color: white;
        }

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
        }

        .width-20 {
            width: 20px;
            text-align: center;
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
                    <li class="nav-item"><a class="nav-link" href="donor_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="find_events.html">Find Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_history.html">My History</a></li>
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
            <div class="px-4 pb-2 text-label">Main Menu</div>
            <a href="/donor/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link active"><i class="fas fa-search w-25"></i> Find Events</a>
            <a href="/donor/history" class="nav-link"><i class="fas fa-history w-25"></i> My History</a>
            <a href="/donor/feedback" class="nav-link"><i class="fas fa-comment-dots w-25"></i> Feedback</a>
            <a href="/donor/profile" class="nav-link"><i class="fas fa-user-circle w-25"></i> Profile</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light">
                <div class="bg-light rounded-3 p-2 text-secondary"><i class="fas fa-sign-out-alt"></i></div>
                <div>
                    <div class="fw-bold text-dark small">Donor</div>
                    <div class="text-label text-danger">Sign Out</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-black mb-0">Find Events</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">Donor</div>
                    <div class="text-label text-success">Verified Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div class="position-relative w-100 w-md-50" style="max-width: 400px;">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                <input type="text" class="form-control rounded-pill ps-5 py-2 border-0 shadow-sm" placeholder="Search Event...">
            </div>
        </div>

        <div class="row g-4">
            <!-- Event Active -->
            <div class="col-md-6 col-xl-4">
                <div class="custom-card h-100 d-flex flex-column">
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center position-relative" style="height: 160px;">
                        <i class="fas fa-hospital fa-3x text-secondary opacity-25"></i>
                        <span class="position-absolute top-0 end-0 m-3 status-badge badge-success">Active</span>
                    </div>
                    <div class="p-4 grow d-flex flex-column">
                        <h5 class="fw-bold mb-3">Red Cross Annual Drive</h5>
                        <div class="vstack gap-2 mb-4 text-secondary small fw-bold">
                            <div><i class="fas fa-map-marker-alt me-2 width-20"></i> City Hall, Main Wing</div>
                            <div><i class="fas fa-calendar me-2 width-20"></i> 2026-01-10</div>
                            <div><i class="fas fa-clock me-2 width-20"></i> 09:00 - 17:00</div>
                        </div>
                        <div class="mt-auto border-top pt-3 d-flex justify-content-between align-items-center">
                            <span class="text-label text-success">12 Slots Left</span>
                            <button class="btn btn-primary-custom btn-sm">Book Visit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Closed -->
            <div class="col-md-6 col-xl-4">
                <div class="custom-card h-100 d-flex flex-column opacity-75">
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center position-relative" style="height: 160px;">
                        <i class="fas fa-hospital fa-3x text-secondary opacity-25"></i>
                        <span class="position-absolute top-0 end-0 m-3 status-badge bg-secondary text-white">Closed</span>
                    </div>
                    <div class="p-4 grow d-flex flex-column">
                        <h5 class="fw-bold mb-3">University Donation Day</h5>
                        <div class="vstack gap-2 mb-4 text-secondary small fw-bold">
                            <div><i class="fas fa-map-marker-alt me-2 width-20"></i> Campus Gym</div>
                            <div><i class="fas fa-calendar me-2 width-20"></i> 2025-12-20</div>
                            <div><i class="fas fa-clock me-2 width-20"></i> Closed</div>
                        </div>
                        <div class="mt-auto border-top pt-3 d-flex justify-content-between align-items-center">
                            <span class="text-label text-secondary">0 Slots Left</span>
                            <button class="btn btn-secondary btn-sm" disabled>Closed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>