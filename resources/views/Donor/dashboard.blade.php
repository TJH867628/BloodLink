<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Donor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #DC2626;
            --primary-dark: #B91C1C;
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

        /* Sidebar Styling */
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

        /* Mobile Navbar */
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

        .find-event-btn {
            background: white;
            transition: all 0.3s ease;
        }

        .find-event-btn:hover {
            background: #000;
            color: white;
            transform: translateX(4px);
        }

        .view-all-link {
            color: #dc2626;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .view-all-link:hover {
            color: #000;
            text-decoration: underline;
            transform: translateX(3px);
        }

        /* Card Styling */
        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            overflow: hidden;
        }

        .hero-card {
            background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
            color: white;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
        }

        /* Status Badges */
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

        .badge-success {
            background-color: #D1FAE5;
            color: #047857;
        }

        .badge-deffered {
            background-color: #FEF2F2;
            color: #DC2626;
        }

        /* Utility */
        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94A3B8;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="donor_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="find_events.html">Find Events</a></li>
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
            <a href="/donor/dashboard" class="nav-link active">
                <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                Dashboard
            </a>
            <a href="/donor/findEvent" class="nav-link">
                <span class="nav-icon"><i class="fas fa-search"></i></span>
                Find Events
            </a>
            <a href="/donor/history" class="nav-link">
                <span class="nav-icon"><i class="fas fa-history"></i></span>
                My History
            </a>
            <a href="/donor/feedback" class="nav-link">
                <span class="nav-icon"><i class="fas fa-comment-dots"></i></span>
                Feedback
            </a>
            <a href="/donor/profile" class="nav-link">
                <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
                Profile
            </a>
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
        <!-- Header -->
         @php
        $missingHealth =
            !$donorHealthDetails ||
            !$donorHealthDetails->blood_type ||
            !$donorHealthDetails->weight ||
            !$donorHealthDetails->height ||
            !$donorHealthDetails->blood_pressure ||
            !$donorHealthDetails->hemoglobin_level;
        @endphp
        @if($missingHealth)
        <div class="alert alert-warning d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Incomplete Health Profile:</strong> Please update your health details to ensure eligibility for donation.
            </div>
            <a href="/donor/profile" class="btn btn-sm btn-danger fw-bold">Update Now</a>
        </div>
        @endif
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Dashboard</h2>
                <div class="d-none d-md-flex align-items-center gap-2 mt-1">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                        <i class="fas fa-check-circle me-1"></i> Authorized
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-4">
                <button class="btn border-0 position-relative text-secondary">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">{{ $user->name }}</div>
                        <div class="text-label text-success">Donor</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <!-- Hero Card -->
        <div class="custom-card hero-card p-4 p-lg-5 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold display-6 mb-3">Welcome back, Donor!</h1>
                    <p class="opacity-75 fs-5 mb-4">You are currently eligible to donate!</p>
                    <a href="/donor/findEvent" class="btn find-event-btn text-danger fw-bold rounded-pill px-4 py-2 shadow-sm text-decoration-none">
                        Find Event <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="fas fa-heart fa-10x opacity-25"></i>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Health Profile -->
            <div class="col-lg-4">
                <div class="custom-card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Health Profile</h5>
                    </div>
                    <div class="vstack gap-3">
                        <div class="d-flex justify-content-between border-bottom pb-3">
                            <span class="text-label">Blood Type</span>
                            <span class="fw-bold text-danger fs-5">{{ $donorHealthDetails->blood_type ?? "Pending For Update" }}</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-3">
                            <span class="text-label">Weight</span>
                            <span class="fw-bold text-dark">{{ $donorHealthDetails->weight ?? "Pending For Update"}}</span>
<<<<<<< Updated upstream
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-3">
                            <span class="text-label">Height</span>
                            <span class="fw-bold text-dark">172 cm</span>
=======
>>>>>>> Stashed changes
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-3">
                            <span class="text-label">Eligibility</span>
                            @if( $donorHealthDetails->is_eligible ?? false)
                            <span class="status-badge badge-eligible">Eligible</span>
                            @else
                            <span class="status-badge badge-deffered">Not Eligible</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-3">
                            <span class="text-label">Last Donation</span>
                            <span class="fw-bold text-dark">
<<<<<<< Updated upstream
                                @if($donorHealthDetails->last_donation_date)
                                    {{ \Carbon\Carbon::parse($donorHealthDetails->last_donation_date)->format('d M Y') }}
=======
                                @if($lastDonation)
                                    {{ \Carbon\Carbon::parse($lastDonation->created_at)->format('d M Y') }}
>>>>>>> Stashed changes
                                @else
                                    No Previous Donations
                                @endif
                        </div>
                        <a href="{{ route('donor.profile') }}"
                            class="btn w-100 btn-light text-danger fw-bold mt-2 border">
                            Update Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-lg-8">
                <div class="custom-card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Recent Activity</h5>
                        <a href="/donor/history" class="view-all-link">View All</a>
                    </div>
                    <div class="vstack gap-3">
                    @forelse($recentActivities as $a)

                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white p-3 rounded-3 shadow-sm
                                @if($a->status == 'COMPLETED') text-danger
                                @else text-secondary
                                @endif">
                                
                                @if($a->status == 'COMPLETED')
                                    <i class="fas fa-hospital"></i>
                                @elseif($a->status == 'ACCEPTED' || $a->status == 'PENDING')
                                    <i class="fas fa-calendar-check"></i>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                @endif
                            </div>

                            <div>
                                <div class="fw-bold">{{ $a->name }}</div>
                                <div class="text-label">
                                    {{ \Carbon\Carbon::parse($a->date)->format('d M Y') }} •
                                    {{ \Carbon\Carbon::parse($a->time)->format('h:i A') }}
                                </div>
                            </div>
                        </div>

                        <span class="status-badge
                            @if($a->status == 'COMPLETED') badge-success
                            @elseif($a->status == 'ACCEPTED' || $a->status == 'PENDING') badge-eligible
                            @else badge-deffered
                            @endif">
                            {{ $a->status == 'COMPLETED' ? 'Successful' : ($a->status == 'ACCEPTED' || $a->status == 'PENDING' ? 'Pending' : 'Deferred') }}
                        </span>
                    </div>

                    @empty
                    <div class="text-center text-muted py-4">
                        No recent activity
                    </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>