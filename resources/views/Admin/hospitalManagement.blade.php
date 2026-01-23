<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Hospital Management</title>
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
    </style>
</head>

<body>
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Admin Portal</div>
            <a href="/admin/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/admin/userManagement" class="nav-link"><i class="fas fa-users w-25"></i> User Mgmt</a>
            <a href="/admin/hospitalManagement" class="nav-link active"><i class="fas fa-hospital w-25"></i> Hospital Mgmt</a>
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
                <h2 class="fw-black mb-0">Hospital Management</h2>
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
                <h5 class="fw-bold mb-0">Registered Facilities</h5>
                <button class="btn btn-danger rounded-pill fw-bold px-4" data-bs-toggle="modal" data-bs-target="#addHospitalModal"><i class="fas fa-plus me-2"></i> Add Hospital</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Facility Name</th>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-bold">City Central Hospital</td>
                            <td class="text-muted small">FAC-001</td>
                            <td>Trauma Center</td>
                            <td>Cyberjaya</td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editHospitalModal"><i class="fas fa-edit"></i></button></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">East Medical Clinic</td>
                            <td class="text-muted small">FAC-002</td>
                            <td>Clinic</td>
                            <td>Puchong</td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editHospitalModal"><i class="fas fa-edit"></i></button></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">West Wing Blood Bank</td>
                            <td class="text-muted small">FAC-004</td>
                            <td>Blood Bank</td>
                            <td>Subang Jaya</td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editHospitalModal"><i class="fas fa-edit"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Hospital Modal -->
    <div class="modal fade" id="addHospitalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Register New Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Facility Name</label>
                            <input type="text" class="form-control rounded-3" placeholder="e.g. North District Hospital">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Facility ID</label>
                                <input type="text" class="form-control rounded-3" placeholder="FAC-XXX">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Type</label>
                                <select class="form-select rounded-3">
                                    <option>General Hospital</option>
                                    <option>Clinic</option>
                                    <option>Blood Bank</option>
                                    <option>Trauma Center</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Location / Address</label>
                            <input type="text" class="form-control rounded-3" placeholder="City, State">
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Contact Number</label>
                            <input type="tel" class="form-control rounded-3" placeholder="+60 3-xxxx xxxx">
                        </div>
                        <button type="button" class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Register Facility</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Hospital Modal -->
    <div class="modal fade" id="editHospitalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Edit Facility Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Facility Name</label>
                            <input type="text" class="form-control rounded-3" value="City Central Hospital">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Facility ID</label>
                                <input type="text" class="form-control rounded-3" value="FAC-001" readonly>
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Type</label>
                                <select class="form-select rounded-3">
                                    <option selected>Trauma Center</option>
                                    <option>General Hospital</option>
                                    <option>Clinic</option>
                                    <option>Blood Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Location / Address</label>
                            <input type="text" class="form-control rounded-3" value="Cyberjaya, Selangor">
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Contact Number</label>
                            <input type="tel" class="form-control rounded-3" value="+60 3-8888 1234">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light flex-fill py-3 rounded-pill fw-bold border" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-dark flex-fill py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>