<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Event Management</title>
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

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        /* Navigation Styles */
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

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px 16px;
            border: 2px solid #F1F5F9;
            background-color: #F8FAFC;
            font-weight: 500;
        }

        .form-control:focus {
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="/event_organizer.dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/event_organizer/eventManagement">Event Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/participation">Participation</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label" style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Organizer Portal</div>
            <a href="/event_organizer/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/event_organizer/eventManagement" class="nav-link active"><span class="nav-icon"><i class="fas fa-calendar-alt w-25"></i></span> Event Management</a>
            <a href="/event_organizer/participation" class="nav-link"><span class="nav-icon"><i class="fas fa-users w-25"></i></span> Participation</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="#" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">Organizer</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Event Management</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Create new blood drives or update existing details.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">Organizer</div>
                    <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Event Organizer</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="custom-card">
            <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Managed Events</h5>
                <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#eventModal"><i class="fas fa-plus me-2"></i> Create New Event</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Event Details</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Location</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Capacity</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">Red Cross Annual Drive</div>
                                <div class="small text-muted">10 Jan 2026 • 09:00 AM - 05:00 PM</div>
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium"><i class="fas fa-map-pin me-1 text-danger"></i> City Hall</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-primary" style="width: 76%"></div>
                                    </div>
                                    <span class="small fw-bold">38/50</span>
                                </div>
                            </td>
                            <td class="px-4 py-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span></td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-light btn-sm text-secondary" title="Edit Event" data-bs-toggle="modal" data-bs-target="#editEventModal"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-light btn-sm text-danger" title="Delete Event"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">Community Health Fair</div>
                                <div class="small text-muted">15 Jan 2026 • 10:00 AM - 03:00 PM</div>
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium"><i class="fas fa-map-pin me-1 text-danger"></i> Downtown Plaza</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-warning" style="width: 13%"></div>
                                    </div>
                                    <span class="small fw-bold">4/30</span>
                                </div>
                            </td>
                            <td class="px-4 py-3"><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span></td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-light btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#editEventModal"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-light btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 opacity-50">
                                <div class="fw-bold text-dark">University Donation Day</div>
                                <div class="small text-muted">20 Dec 2025 • Completed</div>
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium opacity-50">Campus Gym</td>
                            <td class="px-4 py-3 opacity-50">
                                <span class="small fw-bold">100/100</span>
                            </td>
                            <td class="px-4 py-3"><span class="badge bg-secondary text-white rounded-pill">Completed</span></td>
                            <td class="px-4 py-3 text-end">
                                <button class="btn btn-light btn-sm text-secondary" disabled><i class="fas fa-lock"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Create Donation Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Event Name</label>
                            <input type="text" class="form-control" placeholder="e.g. City Mall Blood Drive">
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Venue / Location</label>
                            <input type="text" class="form-control" placeholder="e.g. Main Atrium">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Time</label>
                                <input type="time" class="form-control">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Maximum Donors</label>
                            <input type="number" class="form-control" placeholder="e.g. 50">
                        </div>
                        <button type="button" class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal (New Addition) -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold text-dark">Update Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="alert alert-light border border-secondary-subtle d-flex align-items-center mb-4 rounded-3 p-3">
                            <i class="fas fa-info-circle text-primary me-3 fs-5"></i>
                            <div class="small text-muted lh-sm">
                                Changes to date or venue will automatically notify all <strong>registered donors</strong> via notification page.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Event Name</label>
                            <input type="text" class="form-control fw-bold" value="Red Cross Annual Drive">
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Venue / Location</label>
                            <input type="text" class="form-control" value="City Hall, Main Wing">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Date</label>
                                <input type="date" class="form-control" value="2026-01-10">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Time</label>
                                <input type="time" class="form-control" value="09:00">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Maximum Donors</label>
                            <input type="number" class="form-control" value="50">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light w-50 py-3 rounded-pill fw-bold border" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-dark w-50 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>