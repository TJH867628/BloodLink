<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Hospital Profile</title>
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

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #F1F5F9;
            background-color: #F8FAFC;
            font-weight: 500;
        }

        .facility-badge {
            width: 64px;
            height: 64px;
            background-color: #ECFDF5;
            color: #059669;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Mobile Navigation Bar -->
    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="hospital_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospital_inventory.html">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="hospital_profile.html">Profile</a></li>
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
            <a href="/medical_facilities/bloodManagement" class="nav-link"><i class="fas fa-exchange-alt w-25"></i> Blood Management</a>
            <a href="/medical_facilities/profile" class="nav-link active"><i class="fas fa-hospital w-25"></i> Profile</a>
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
        <!-- Header Section -->
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Medical Facilities Staff Profile</h2>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <a href="/medical_facilities/notification" class="btn border-0 position-relative text-secondary">
                        <i class="fas fa-bell fa-lg"></i>
                        @if($hasUnreadNotifications)
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                        @endif
                    </a>
                    <div class="text-end d-none d-md-block">
                         <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">{{ $user->role }}</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Hospital" class="rounded-3 border"
                        width="40" height="40" alt="Avatar">
                </div>
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

        <div class="row g-4">
            <!-- Facility Info Card -->
            <div class="col-lg-5">
                <div class="custom-card p-4 h-100">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="facility-badge"><i class="fas fa-hospital-alt"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $medical_facility->name }}</h5>
                            <p class="text-muted small mb-0">{{ $medical_facility->type }}</p>
                        </div>
                    </div>
                    <div class="vstack gap-3">
                        <div class="p-3 bg-light rounded-4 border">
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Address</small>
                            <div class="fw-bold text-dark mt-1">{{ $medical_facility->address }}</div>
                        </div>
                        <div class="alert alert-info border-0 d-flex gap-2 align-items-center mb-0 mt-2">
                            <i class="fas fa-info-circle"></i>
                            <span class="small fw-bold">To update facility details, please contact the System Administrator.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Account Settings -->
            <div class="col-lg-7">
                <div class="custom-card p-4 p-md-5 h-100">
                    <h5 class="fw-bold mb-4">Staff Account Settings</h5>
                    <form method="post" action="{{route('medical_facilities.updateProfile')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Staff Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email Address</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Role</label>
                            <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Save Changes</button>
                        </div>
                    </form>

                        <hr class="my-4">
                    <form method="post" action="{{  route('medical_facilities.changePassword') }}">
                        @csrf
                        <h6 class="fw-bold mb-3">Security</h6>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Current Password</label>
                            <input type="password" name="current_password" class="form-control" placeholder="••••••••">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">New Password</label>
                            <input type="password" name="new_password" minlength="8" class="form-control" placeholder="New password">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                            <input type="password" name="confirm_password" minlength="8" class="form-control" placeholder="Confirm new password">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>