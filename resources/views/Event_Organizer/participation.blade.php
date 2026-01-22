<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Donor Participation</title>
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

        .form-select {
            border-radius: 12px;
            padding: 10px 16px;
            border: 2px solid #F1F5F9;
            background-color: #F8FAFC;
            font-weight: 500;
        }

        .form-select:focus {
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
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/eventManagement">Event Management</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/event_organizer/participation">Participation</a></li>
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
            <a href="/event_organizer/eventManagement" class="nav-link"><span class="nav-icon"><i class="fas fa-calendar-alt w-25"></i></span> Event Management</a>
            <a href="/event_organizer/participation" class="nav-link active"><span class="nav-icon"><i class="fas fa-users w-25"></i></span> Participation</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
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
                <h2 class="fw-black mb-0">Donor Participation</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Monitor registrations and attendance for your drives.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">Organizer</div>
                    <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Event Organizer</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="row g-4 mb-4">
            <!-- Filter Section -->
            <div class="col-12">
                <div class="custom-card p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3 w-100 w-md-50">
                        <i class="fas fa-filter text-muted"></i>
                        <select class="form-select">
                            <option selected>All Events</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-outline-secondary rounded-pill px-4 fw-bold"><i class="fas fa-download me-2"></i> Export Data</button>
                </div>
            </div>
        </div>

        <!-- Participants Table -->
        <div class="custom-card">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Donor</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Event Assigned</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Time Slot</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Contact</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appoinments as $app)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-danger-subtle text-danger rounded p-1 fw-bold small text-center" style="width: 32px;">
                                        {{ strtoupper(substr($app->donor_name,0,1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $app->donor_name }}</div>
                                        <div class="small text-muted">ID: {{ $app->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 fw-bold text-dark">{{ $app->event_name }}</td>
                            <td class="px-4 py-3 text-muted">{{ \Carbon\Carbon::parse($app->event_date)->format('d M Y') }} . {{ $app->event_time }}</td>
                            <td class="px-4 py-3 small">
                                <i class="fas fa-phone me-1 text-muted"></i> {{ $app->phone }}
                            </td>

                            <td class="px-4 py-3">
                                @if($app->status == 'ACCEPTED')
                                    <span class="badge bg-primary-subtle text-primary rounded-pill">ACCEPTED</span>
                                @elseif($app->status == 'PENDING')
                                    <span class="badge bg-warning-subtle text-warning rounded-pill">Pending</span>
                                @elseif($app->status == 'REJECTED')
                                    <span class="badge bg-danger-subtle text-danger rounded-pill">Rejected</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-end">
                                <form method="POST" action="/event_organizer/acceptAppointment/{{ $app->id }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-light btn-sm text-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <form method="POST" action="/event_organizer/rejectAppointment/{{ $app->id }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-light btn-sm text-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>