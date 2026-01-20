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
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div>
            <span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label" style="color: #94A3B8; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Main Menu</div>
            <a href="/donor/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link"><i class="fas fa-search w-25"></i> Find Events</a>
            <a href="/donor/history" class="nav-link active"><i class="fas fa-history w-25"></i> My History</a>
            <a href="/donor/feedback" class="nav-link"><i class="fas fa-comment-dots w-25"></i> Feedback</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light">
                <div class="bg-light rounded-3 p-2 text-secondary"><i class="fas fa-sign-out-alt"></i></div>
                <div>
                    <div class="fw-bold text-dark small">Donor</div>
                    <div class="text-label text-danger" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Sign Out</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-black mb-0">Donation History</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">Donor</div>
                    <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Verified Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <!-- Filters -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <button class="filter-btn active">All Records</button>
            <button class="filter-btn">Successful</button>
            <button class="filter-btn">Pending</button>
            <button class="filter-btn">Deferred</button>
        </div>

        <!-- History List -->
        <div class="vstack gap-3">
            <!-- Record Successful -->
            <div class="history-card">
                <div class="date-box">
                    <div class="date-day">30</div>
                    <div class="date-month">DEC 2025</div>
                </div>

                <div class="history-content">
                    <div class="history-header">
                        <h5>General Hospital</h5>
                        <span class="status-badge success">Successful</span>
                    </div>

                    <div class="history-meta">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            Walk-in Visit
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tint"></i>
                            Whole Blood (450ml)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Record Pending -->
            <div class="history-card">
                <div class="date-box">
                    <div class="date-day">15</div>
                    <div class="date-month">Aug 2025</div>
                </div>

                <div class="history-content">
                    <div class="history-header">
                        <h5>Red Cross Annual Drive</h5>
                        <span class="status-badge pending">Pending</span>
                    </div>

                    <div class="history-meta">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            City Hall, Main Wing
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tint"></i>
                            Whole Blood (450ml)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Record Deferred -->
            <div class="history-card">
                <div class="date-box">
                    <div class="date-day text-muted">10</div>
                    <div class="date-month">Apr 2025</div>
                </div>

                <div class="history-content">
                    <div class="history-header text-muted">
                        <h5>Community Center Drive</h5>
                        <span class="status-badge badge-failed">Deferred</span>
                    </div>

                    <div class="history-meta text-muted">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            Mobile Unit 4
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-exclamation"></i>
                            not meet requirements
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>