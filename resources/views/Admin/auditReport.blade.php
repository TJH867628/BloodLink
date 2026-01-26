<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Audit & Reports</title>
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
        }

        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .log-terminal {
            background: #0F172A;
            color: #10B981;
            font-family: monospace;
            padding: 1.5rem;
            border-radius: 16px;
            height: 400px;
            overflow-y: auto;
            font-size: 0.85rem;
        }

        .nav-tabs .nav-link {
            border: none;
            color: var(--text-muted);
            font-weight: 600;
            padding: 1rem 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-red);
            border-bottom: 3px solid var(--primary-red);
            background: none;
        }
    </style>
</head>

<body>
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span
                class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Admin Portal</div>
            <a href="/admin/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Management</a>
            <a href="/admin/medicalFacilitiesManagement" class="nav-link"><i class="fas fa-hospital w-25"></i>Medical
                Facilities Management</a>
            <a href="/admin/inventory" class="nav-link"><i class="fas fa-hospital w-25"></i>Blood Inventories</a>
            <a href="/admin/systemModification" class="nav-link"><i class="fas fa-cogs w-25"></i> System
                Modification</a>
            <a href="/admin/auditReport" class="nav-link active"><i class="fas fa-file-alt w-25"></i> Audit &
                Reports</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
         <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Audit Log & Reports</h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="/admin/notification" class="btn border-0 position-relative text-secondary">
                    <i class="fas fa-bell fa-lg"></i>
                    @if($hasUnreadNotifications)
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    @endif
                </a>
                <div class="text-end d-none d-md-block">
                     <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-primary" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">{{ $user->role }}</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" class="rounded-3 border" width="40"
                    height="40" alt="Avatar">
            </div>
        </header>

        <ul class="nav nav-tabs mb-4" id="reportTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" id="audit-tab" data-bs-toggle="tab"
                    data-bs-target="#audit" type="button">Audit Logs</button></li>
            <li class="nav-item"><button class="nav-link" id="reports-tab" data-bs-toggle="tab"
                    data-bs-target="#reports" type="button">System Reports</button></li>
        </ul>

        <div class="tab-content" id="reportTabsContent">
            <!-- Audit Log Tab -->
            <div class="tab-pane fade show active" id="audit" role="tabpanel">
                <div class="log-terminal shadow-lg">
                    @foreach($logs as $log)
                        @php
                            $role = strtoupper($log->user_role ?? 'SYSTEM');

                            if ($role === 'ADMIN') {
                                $roleColor = 'text-danger';
                            } elseif ($role === 'HOSPITAL') {
                                $roleColor = 'text-primary';
                            } elseif ($role === 'DONOR') {
                                $roleColor = 'text-success';
                            } else {
                                $roleColor = 'text-warning'; // SYSTEM
                            }
                        @endphp

                        <div class="mb-2">
                            <span class="text-secondary">
                                [{{ \Carbon\Carbon::parse($log->timestamp)->format('Y-m-d H:i:s') }}]
                            </span>

                            <span class="{{ $roleColor }} fw-bold">
                                @if($log->user_id)
                                    {{ $role }}_{{ $log->user_id }} ({{ $log->user_name }}):
                                @else
                                    SYSTEM:
                                @endif
                            </span>

                            <span class="text-white">
                                {{ $log->action }}
                            </span>
                        </div>
                    @endforeach

                    <div class="mt-3 opacity-50">_ Waiting for new events...</div>

                </div>
            </div>

            <div class="tab-pane fade" id="reports" role="tabpanel">
                <div class="row g-4">

                    <!-- BLOOD INVENTORY -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-boxes text-success fa-3x mb-3"></i>
                            <h5 class="fw-bold">Blood Inventory</h5>
                            <p class="text-muted small">Current blood stock snapshot</p>

                            <form action="{{ route('admin.exportBloodInventory') }}" method="GET">
                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- USERS -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-users text-secondary fa-3x mb-3"></i>
                            <h5 class="fw-bold">Users</h5>
                            <p class="text-muted small">All donors, staff & organizers</p>

                            <form action="{{ route('admin.exportUserSummary') }}" method="GET">

                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- BLOOD USAGE -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-tint text-warning fa-3x mb-3"></i>
                            <h5 class="fw-bold">Blood Usage</h5>
                            <p class="text-muted small">Blood used in hospitals</p>

                            <form action="{{ route('admin.exportBloodUsage') }}" method="GET">
                                <div class="d-flex gap-2 mb-2">
                                    <input type="date" name="from" class="form-control form-control-sm">
                                    <input type="date" name="to" class="form-control form-control-sm">
                                </div>

                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>


                    <!-- BLOOD WASTAGE -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                            <h5 class="fw-bold">Blood Wastage</h5>
                            <p class="text-muted small">Expired & discarded blood</p>

                            <form action="{{ route('admin.exportBloodWastage') }}" method="GET">
                                <div class="d-flex gap-2 mb-2">
                                    <input type="date" name="from" class="form-control form-control-sm">
                                    <input type="date" name="to" class="form-control form-control-sm">
                                </div>

                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>


                    <!-- DONATIONS -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-hand-holding-heart text-primary fa-3x mb-3"></i>
                            <h5 class="fw-bold">Donations</h5>
                            <p class="text-muted small">All donation records</p>

                            <form action="{{ route('admin.exportDonationRecords') }}" method="GET">
                                <div class="d-flex gap-2 mb-2">
                                    <input type="date" name="from" class="form-control form-control-sm">
                                    <input type="date" name="to" class="form-control form-control-sm">
                                </div>

                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>


                    <!-- EVENTS -->
                    <div class="col-md-4">
                        <div class="custom-card p-4 text-center h-100">
                            <i class="fas fa-calendar-alt text-info fa-3x mb-3"></i>
                            <h5 class="fw-bold">Events</h5>
                            <p class="text-muted small">Blood drive events</p>

                            <form action="{{ route('admin.exportEvent') }}" method="GET">
                                <div class="d-flex gap-2 mb-2">
                                    <input type="date" name="from" class="form-control form-control-sm">
                                    <input type="date" name="to" class="form-control form-control-sm">
                                </div>

                                <select name="format" class="form-select form-select-sm mb-3">
                                    <option value="xlsx">Excel (.xlsx)</option>
                                    <option value="csv">CSV</option>
                                </select>

                                <button class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold w-100">
                                    Download
                                </button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>