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
            <a href="/donor/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link"><i class="fas fa-search w-25"></i> Find Events</a>
            <a href="/donor/history" class="nav-link"><i class="fas fa-history w-25"></i> My History</a>
            <a href="/donor/feedback" class="nav-link"><i class="fas fa-comment-dots w-25"></i> Feedback</a>
            <a href="/donor/profile" class="nav-link active"><i class="fas fa-user-circle w-25"></i> Profile</a>
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
        <header class="mb-5">
            <h2 class="fw-black mb-0">My Profile</h2>
            <p class="text-muted small fw-medium mt-1">Manage your personal information and health details.</p>
        </header>

        <div class="row g-4">
            <!-- Profile Status -->
            <div class="col-lg-4">
                <div class="custom-card p-4 text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="avatar-upload" alt="Profile">
                        <button class="btn btn-sm btn-dark rounded-circle position-absolute bottom-0 end-0 border border-white" style="width: 32px; height: 32px;"><i class="fas fa-camera small"></i></button>
                    </div>
                    <h5 class="fw-bold mb-1">Donor</h5>
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">Eligible</span>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">A+ Positive</span>
                    </div>
                    <div class="border-top pt-3 text-start">
                        <small class="fw-bold text-muted text-uppercase" style="font-size: 0.7rem;">Account Status</small>
                        <div class="d-flex align-items-center gap-2 mt-2">
                            <i class="fas fa-check-circle text-success"></i> <span class="small fw-bold">Email Verified</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-2">
                            <i class="fas fa-check-circle text-success"></i> <span class="small fw-bold">Phone Verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form-->
            <div class="col-lg-8">
                <div class="custom-card p-4 p-md-5">
                    <form>
                        <h5 class="fw-bold mb-4">Personal Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Full Name</label>
                                <input type="text" class="form-control" value="Donor">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email Address</label>
                                <input type="email" class="form-control" value="donor@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Phone Number</label>
                                <input type="tel" class="form-control" value="+60 12-345 6789">
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <h5 class="fw-bold mb-4 text-danger">Health Details</h5>
                        <div class="alert alert-warning border-0 d-flex gap-3 mb-4 rounded-4">
                            <i class="fas fa-exclamation-triangle mt-1"></i>
                            <div class="small">Please ensure this information is accurate. False health data can endanger patients. Updates may require re-verification.</div>
                        </div>
                        <div class="row g-3 mb-4">
                            <!-- Blood Type -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Blood Type</label>
                                <select class="form-select">
                                    <option value="A+" selected>A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
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
                                    value="58"
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
                                    value="165"
                                    required>
                            </div>
                            <!-- Blood Pressure -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Blood Pressure (mmHg)</label>
                                <input type="text"
                                    class="form-control"
                                    name="blood_pressure"
                                    placeholder="e.g. 120/80"
                                    pattern="[0-9]{2,3}/[0-9]{2,3}"
                                    value="120/80"
                                    required>
                            </div>
                            <!-- Hemoglobin Level -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Hemoglobin Level (g/dL)</label>
                                <input type="number"
                                    class="form-control"
                                    name="hemoglobin"
                                    placeholder="e.g. 13.5"
                                    step="0.1"
                                    min="8"
                                    max="20"
                                    value="14.2"
                                    required>
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