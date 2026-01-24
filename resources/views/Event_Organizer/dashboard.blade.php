<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Organizer Dashboard</title>
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

        /* Sidebar & Layout */
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

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        /* Navigation Styles (Your Custom CSS) */
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

        /* Logout Styles (Your Custom CSS) */
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

            .mobile-nav {
                display: block !important;
            }
        }

        /* Dashboard Specific */
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

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.05em;
        }

        .progress-thin {
            height: 6px;
            border-radius: 3px;
            background-color: #F1F5F9;
            margin-top: 10px;
        }

        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
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
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/event_organizer/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/eventManagement">Event Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/participation">Participation</a></li>
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
            <div class="px-4 pb-2 text-label">Organizer Portal</div>
            <a href="/event_organizer/dashboard" class="nav-link active"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/event_organizer/eventManagement" class="nav-link"><span class="nav-icon"><i class="fas fa-calendar-alt w-25"></i></span> Event Management</a>
            <a href="/event_organizer/participation" class="nav-link"><span class="nav-icon"><i class="fas fa-users w-25"></i></span> Participation</a>
            <a href="/event_organizer/profile" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Profile</a>
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

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Dashboard</h2>
            </div>
            <div class="d-flex align-items-center gap-4">
                <a href="/event_organizer/notification" class="btn border-0 position-relative text-secondary">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </a>
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">Organizer</div>
                        <div class="text-label text-success">Event Organizer</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer" class="rounded-3 border" width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label">Active Events</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0">{{ count($events) }}</h2>
                        <span class="text-muted small fw-bold">Event</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">Currently accepting donors</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label text-primary">Total Registered</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-primary">{{ $totalRegisteredDonors }}</h2>
                        <span class="text-muted small fw-bold">Donors</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">Across all upcoming events</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="text-label text-success">Slot Capacity</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-success">{{ $slotCapacity }}%</h2>
                        <span class="text-muted small fw-bold">Filled</span>
                    </div>
                    <div class="progress progress-thin">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card border-warning">
                    <div class="text-label text-warning">Pending Actions</div>
                    <div class="d-flex align-items-end justify-content-between mt-2">
                        <h2 class="fw-black mb-0 text-warning">{{ $totalPendingAcceptDonors }}</h2>
                        <span class="badge bg-warning-subtle text-warning">Review</span>
                    </div>
                    <div class="mt-3 text-muted" style="font-size: 0.75rem;">New donor registrations</div>
                </div>
            </div>
        </div>

        <!-- Recent Events Table -->
        <div class="custom-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Upcoming Events</h5>
                <a href="/event_organizer/eventManagement" class="btn btn-link text-danger fw-bold text-decoration-none small">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Event Name</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Date & Time</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Location</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Slots</th>
                            <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-3 fw-bold">Red Cross Annual Drive</td>
                            <td class="px-4 py-3 text-muted small">10 Jan 2026 • 09:00 AM</td>
                            <td class="px-4 py-3 text-muted small"><i class="fas fa-map-marker-alt me-1"></i> City Hall</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress grow" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 76%"></div>
                                    </div>
                                    <span class="small fw-bold text-primary">38/50</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-end"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 fw-bold">Community Health Fair</td>
                            <td class="px-4 py-3 text-muted small">15 Jan 2026 • 10:00 AM</td>
                            <td class="px-4 py-3 text-muted small"><i class="fas fa-map-marker-alt me-1"></i> Downtown</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress grow" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 15%"></div>
                                    </div>
                                    <span class="small fw-bold text-warning">4/30</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-end"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>