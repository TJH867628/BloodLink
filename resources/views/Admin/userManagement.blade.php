<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        /* Shared CSS from Dashboard */
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
    </style>
</head>

<body>
    <!-- Sidebar (Same as Dashboard) -->
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Admin Portal</div>
            <a href="/admin/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link active"><i class="fas fa-users w-25"></i> User Mgmt</a>
            <a href="/admin/hospitalManagement" class="nav-link"><i class="fas fa-hospital w-25"></i> Hospital Mgmt</a>
            <a href="/admin/systemModification" class="nav-link"><i class="fas fa-cogs w-25"></i> System Modification</a>
            <a href="/admin/auditReport" class="nav-link"><i class="fas fa-file-alt w-25"></i> Audit & Reports</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">Admin</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">User Management</h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">System Admin</div>
                    <div class="text-label text-primary">Superadmin</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Admin" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="custom-card">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                <input type="text" class="form-control rounded-pill ps-4" style="max-width: 300px;" placeholder="Search users...">
                <button class="btn btn-primary rounded-pill fw-bold px-4" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-user-plus me-2"></i> Add User</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">Nesandra Ann</div>
                                <div class="small text-muted">nesandra@donor.com</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">Donor</span></td>
                            <td><span class="badge bg-success-subtle text-success rounded-pill">Active</span></td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">Chai Yu Xuan</div>
                                <div class="small text-muted">chai@hospital.com</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">Hospital Staff</span></td>
                            <td><span class="badge bg-success-subtle text-success rounded-pill">Active</span></td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold">Praveena Nair</div>
                                <div class="small text-muted">praveena@event.org</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">Organizer</span></td>
                            <td><span class="badge bg-warning-subtle text-warning rounded-pill">Pending</span></td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light text-danger"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="modal-title fw-bold">Provision New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="mb-3">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Full Name</label>
                                <input type="text" class="form-control" placeholder="e.g. John Doe">
                            </div>
                            <div class="mb-3">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Email Address</label>
                                <input type="email" class="form-control" placeholder="name@bloodlink.com">
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="text-muted fw-bold small text-uppercase mb-1">System Role</label>
                                    <select class="form-select">
                                        <option value="Donor">Donor</option>
                                        <option value="Hospital">Hospital Staff</option>
                                        <option value="Organizer">Event Organizer</option>
                                        <option value="Admin">Administrator</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="text-muted fw-bold small text-uppercase mb-1">Status</label>
                                    <select class="form-select">
                                        <option value="Active">Active</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Temporary Password</label>
                                <input type="text" class="form-control" value="Welcome@2026" readonly>
                                <div class="form-text small">Default password for first-time login.</div>
                            </div>
                            <button type="button" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Create User Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>