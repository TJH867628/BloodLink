<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Donor Profile</title>
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
            width: 32px;
            /* FIXED WIDTH */
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

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 16px;
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

        .avatar-upload {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-save {
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-save:hover {
            background-color: #B91C1C;
            transform: translateY(-1px);
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

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.05em;
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
                    <li class="nav-item"><a class="nav-link" href="donor_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="donor_profile.html">Profile</a></li>
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
            <div class="px-4 pb-2 text-label" style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Main Menu</div>
            <a href="/donor/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link"><span class="nav-icon"><i class="fas fa-search w-25"></i></span> Find Events</a>
            <a href="/donor/history" class="nav-link"><span class="nav-icon"><i class="fas fa-history w-25"></i></span> My History</a>
            <a href="/donor/feedback" class="nav-link"><span class="nav-icon"><i class="fas fa-comment-dots w-25"></i></span> Feedback</a>
            <a href="/donor/profile" class="nav-link active"><span class="nav-icon"><i class="fas fa-user-circle w-25"></i></span> Profile</a>
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
                <h2 class="fw-black mb-0">My Profile</h2>
                <p class="text-muted small fw-medium mt-1">Manage your personal information and health details.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-success">Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="row g-4">
            <!-- Profile Status -->
            <div class="col-lg-4">
                <div class="custom-card p-4 text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="avatar-upload" alt="Profile">
                    </div>
                    <h5 class="fw-bold mb-1">Donor</h5>
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">Eligible</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                            {{ $donorHealthDetails->blood_type ?? 'Unknown' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Profile Form-->
            <div class="col-lg-8">
                <div class="custom-card p-4 p-md-5">
                    <form method="POST" action="{{ route('donor.updateProfile') }}">
                        @csrf
                        <h5 class="fw-bold mb-4">Personal Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email Address</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <h5 class="fw-bold mb-4 text-danger">Health Details</h5>
                        <div class="alert alert-warning border-0 d-flex gap-3 mb-4 rounded-4">
                            <i class="fas fa-exclamation-triangle mt-1"></i>
                            <div class="small">Please ensure this information is accurate. False health data can endanger patients.</div>
                        </div>
                        <div class="row g-3 mb-4">
                            <!-- Blood Type -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Blood Type</label>
                                <select class="form-select" name="blood_type">
                                    @foreach($bloodTypes as $bt)
                                    <option value="{{ $bt->value }}"
                                        {{ ($donorHealthDetails->blood_type ?? '') == $bt->value ? 'selected' : '' }}>
                                        {{ $bt->value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Weight -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Weight (kg)</label>
                                <input type="number"
                                    class="form-control"
                                    name="weight"
                                    placeholder="e.g. 65"
                                    min="30"
                                    max="200"
                                    step="0.1"
                                    value="{{ $donorHealthDetails->weight ?? "" }}"
                                    required>
                            </div>
                            <!-- Height -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Height (cm)</label>
                                <input type="number"
                                    class="form-control"
                                    name="height"
                                    placeholder="e.g. 170"
                                    min="100"
                                    max="250"
                                    value="{{ $donorHealthDetails->height ?? "" }}"
                                    required>
                            </div>
                            <!-- Blood Pressure -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Blood Pressure e.g. 120/80 (mmHg)</label>
                                <input type="text"
                                    class="form-control"
                                    name="blood_pressure"
                                    placeholder="e.g. 120/80"
                                    pattern="[0-9]{2,3}/[0-9]{2,3}"
                                    value="{{ $donorHealthDetails->blood_pressure ?? "" }}"
                                    required>
                            </div>
                            <!-- Hemoglobin Level -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Hemoglobin Level (g/dL)</label>
                                <input type="number"
                                    class="form-control"
                                    name="hemoglobin_level"
                                    placeholder="e.g. 13.5"
                                    step="0.1"
                                    min="8"
                                    max="20"
                                    value="{{ $donorHealthDetails->hemoglobin_level ?? "" }}"
                                    required>
                            </div>
                            <!-- Last Checkup Date -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Last Checkup Date</label>
                                <input type="date"
                                    class="form-control"
                                    name="last_checkup_date"
                                    value="{{ $donorHealthDetails->last_checkup_date ?? '' }}"
                                    max="{{ now()->toDateString() }}">
                            </div>
                            <!-- Last Donation Date -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Last Donation Date</label>
                                <input type="date"
                                    class="form-control"
                                    name="last_donation_date"
                                    value="{{ $donorHealthDetails->last_donation_date ?? '' }}"
                                    max="{{ now()->toDateString() }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-light fw-bold px-4 rounded-pill border">Cancel</button>
                            <button type="submit" class="btn btn-save px-4 rounded-pill">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>