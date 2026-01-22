<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - My History</title>
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

        /* Sidebar (Same as Dashboard) */
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

        /* History Specific Styles */
        .history-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border-color: #CBD5E1;
        }

        .date-box {
            background-color: #F8FAFC;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            min-width: 80px;
            border: 1px solid #E2E8F0;
        }

        .date-day {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1;
        }

        .date-month {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-top: 4px;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-block;
        }

        .badge-success {
            background-color: #ECFDF5;
            color: #059669;
            border: 1px solid #A7F3D0;
        }

        .badge-pending {
            background-color: #FFFBEB;
            color: #D97706;
            border: 1px solid #FDE68A;
        }

        .badge-failed {
            background-color: #FEF2F2;
            color: #DC2626;
            border: 1px solid #FECACA;
        }

        .vitals-box {
            background-color: #F8FAFC;
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-dark);
            border: 1px solid #E2E8F0;
        }

        .history-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        /* Date box */
        .date-box {
            width: 80px;
            height: 80px;
            background: #f8fafc;
            border-radius: 14px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-weight: 700;
        }

        .date-day {
            font-size: 1.6rem;
            color: #0f172a;
        }

        .date-month {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
        }

        /* Content */
        .history-content {
            flex: 1;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-header h5 {
            margin: 0;
            font-weight: 700;
        }

        /* Status badge */
        .status-badge {
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .status-badge.success {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-badge.pending {
            background: #dbeafe;
            color: #1d4ed8;
        }

        /* Meta info */
        .history-meta {
            display: flex;
            gap: 2rem;
            margin-top: 0.75rem;
            color: #475569;
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item i {
            color: #ef4444;
        }

        .filter-btn {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            color: var(--text-muted);
            transition: all 0.2s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: var(--text-dark);
            color: white;
            border-color: var(--text-dark);
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
                    <li class="nav-item"><a class="nav-link" href="donor_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="find_events.html">Find Events</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="my_history.html">My History</a></li>
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
            <div class="px-4 pb-2 text-label" style="color: #94A3B8; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Main Menu</div>
            <a href="/donor/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link"><span class="nav-icon"><i class="fas fa-search w-25"></i></span> Find Events</a>
            <a href="/donor/history" class="nav-link active"><span class="nav-icon"><i class="fas fa-history w-25"></i></span> My History</a>
            <a href="/donor/feedback" class="nav-link"><span class="nav-icon"><i class="fas fa-comment-dots w-25"></i></span> Feedback</a>
            <a href="/donor/profile" class="nav-link"><span class="nav-icon"><i class="fas fa-user-circle w-25"></i></span> Profile</a>
        </nav>
        <div class="mt-auto border-top p-3">
<<<<<<< Updated upstream
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="logout-text">Sign Out</div>
=======
            <a href="/logout" style="text-decoration:none">
                <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light">
                    <div class="bg-light rounded-3 p-2 text-secondary"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="text-label text-danger" style="cursor:pointer">Sign Out</div>
>>>>>>> Stashed changes
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-black mb-0">Donation History</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-success">Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Filters -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <button class="filter-btn active" data-filter="all">All Records</button>
            <button class="filter-btn" data-filter="completed">Completed</button>
            <button class="filter-btn" data-filter="accepted">Accepted</button>
            <button class="filter-btn" data-filter="pending">Pending</button>
            <button class="filter-btn" data-filter="cancelled">Cancelled</button>
            <button class="filter-btn" data-filter="rejected">Rejected</button>
        </div>

        <!-- History List -->
        <div class="vstack gap-3">
            {{-- Successful donations --}}
            @foreach($donations as $donation)
<<<<<<< Updated upstream
            <div class="history-card" data-status="completed">
=======
            <div class="history-card">
>>>>>>> Stashed changes
                <div class="date-box">
                    <div class="date-day">{{ $donation->created_at->format('d') }}</div>
                    <div class="date-month">{{ $donation->created_at->format('M Y') }}</div>
                </div>

                <div class="history-content">
                    <div class="history-header">
                        <h5>{{ $donation->event->name ?? 'Blood Donation' }}</h5>
                        <span class="status-badge success">Successful</span>
                    </div>

                    <div class="history-meta">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $donation->facility->name ?? 'Medical Facility' }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            {{ $donation->created_at->format('h:i A')   }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tint"></i>
                            {{ $donation->unit }} Bag(s)
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 border-start ps-md-4 mt-3 mt-md-0 pt-3 pt-md-0 border-top-0 border-top-md opacity-75">
                    <div class="text-center">
                        <div class="text-label mb-1">Hemoglobin</div>
                        <div class="vitals-box text-danger border-danger">{{ $donation->hemoglobin_level ?? "NULL"}} g/dL</div>
                    </div>
                    <div class="text-center">
                        <div class="text-label mb-1">Pressure</div>
                        <div class="vitals-box">{{ $donation->blood_pressure ??  "NULL"}}</div>
                    </div>
                </div>
            </div>
            @endforeach

<<<<<<< Updated upstream
            {{-- Appointments (pending / cancelled) --}}
            @foreach($appointments as $app)
            <div class="history-card" data-status="{{ strtolower($app->status) }}">
=======

            {{-- Appointments (pending / cancelled) --}}
            @foreach($appointments as $app)
            <div class="history-card">
>>>>>>> Stashed changes
                <div class="date-box">
                    <div class="date-day">{{ \Carbon\Carbon::parse($app->date)->format('d') }}</div>
                    <div class="date-month">{{ \Carbon\Carbon::parse($app->date)->format('M Y') }}</div>
                </div>

                <div class="history-content">
                    <div class="history-header">
                        <h5>{{ $app->event_name }}</h5>
<<<<<<< Updated upstream
                        <div class="text-end d-flex flex-column align-items-end">
                            <span class="status-badge
                                @if($app->status == 'PENDING' || $app->status == 'ACCEPTED')
                                    pending
                                @elseif($app->status == 'COMPLETED')
                                    badge-success
                                @else
                                    badge-failed
                                @endif
                            ">
                                {{ $app->status }}
                            </span>

                            @if(in_array($app->status, ['PENDING','ACCEPTED']) && \Carbon\Carbon::parse($app->date.' '.$app->time)->isFuture())
                                <form method="POST" action="{{ route('donor.cancelAppointment', $app->id) }}" class="mt-2">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
=======
                        <span class="status-badge 
                            {{ $app->status == 'APPROVED' || $app->status == 'PENDING' ? 'pending' : 'badge-failed' }}">
                            {{ $app->status }}
                        </span>
>>>>>>> Stashed changes
                    </div>

                    <div class="history-meta">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $app->location }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($app->time)->format('h:i A') }}
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 border-start ps-md-4 mt-3 mt-md-0 pt-3 pt-md-0 border-top-0 border-top-md opacity-75">
                </div>
            </div>
            @endforeach
<<<<<<< Updated upstream
        </div>
        <div id="empty-state" class="text-center py-5 d-none">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <h5 class="fw-bold text-muted">No records found</h5>
            <p class="text-muted small">
                There are no records under this status.
            </p>
=======
>>>>>>> Stashed changes
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const historyCards = document.querySelectorAll('.history-card');
    const emptyState = document.getElementById('empty-state');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {

            // Set active button
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filters = btn.dataset.filter.split(',');
            let visibleCount = 0;

            historyCards.forEach(card => {
                const status = card.dataset.status;

                if (filters.includes('all') || filters.includes(status)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show or hide empty state
            if (visibleCount === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        });
    });
</script>
</body>

</html>