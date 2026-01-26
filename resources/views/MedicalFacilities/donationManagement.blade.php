<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Donation Management</title>
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

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px 16px;
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
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="medical_facilities_inventory.html">Inventory &
                            Reports</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger"
                            href="/medical_facilities/donationManagement">Donation Management</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span
                class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label"
                style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Hospital Portal
            </div>
            <a href="/medical_facilities/dashboard" class="nav-link"><i class="fas fa-chart-pie w-25"></i> Dashboard</a>
            <a href="/medical_facilities/inventory" class="nav-link"><i class="fas fa-box-open w-25"></i> Inventory &
                Reports</a>
            <a href="/medical_facilities/donationManagement" class="nav-link active"><i
                    class="fas fa-user-nurse w-25"></i> Donation Management</a>
            <a href="/medical_facilities/bloodManagement" class="nav-link"><i class="fas fa-exchange-alt w-25"></i>
                Blood Management</a>
            <a href="/medical_facilities/profile" class="nav-link"><i class="fas fa-hospital w-25"></i> Profile</a>
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

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Donation Management</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Process today's donor queue and record clinical results.
                </p>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="position-relative d-none d-md-block" style="width: 250px;">
                    <i
                        class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                    <input type="text" class="form-control rounded-pill ps-5" placeholder="Search donor...">
                </div>
                <div class="d-none d-md-block border-start h-50 mx-2"></div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold small">Hospital Staff</div>
                        <div class="text-label text-success"
                            style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Verified Staff</div>
                    </div>
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Hospital" class="rounded-3 border"
                        width="40" height="40" alt="Avatar">
                </div>
            </div>
        </header>

        <div class="row g-4">
            <!-- Queue Section -->
            <div class="col-lg-8">
                <div class="custom-card h-100">
                    <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Today's Queue</h5>
                        <span
                            class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold">{{ $donation_today->count() }}
                            Pending</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Donor</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Scheduled</th>
                                    <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donation_today as $donation)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-danger-subtle text-danger rounded p-1 fw-bold small text-center"
                                                    style="width: 32px;">{{ $donation->blood_type }}</div>
                                                <div>
                                                    <div class="fw-bold">{{ $donation->donor_name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-muted fw-medium">{{ $donation->time }}</td>
                                        <td class="px-4 py-3 text-end">
                                            <button class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3"
                                                data-bs-toggle="modal" data-bs-target="#recordModal"
                                                data-appointment="{{ $donation->appointment_id }}">Record Result</button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($donation_today) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No more donors in the queue
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent History Section -->
            <div class="col-lg-4">
                <div class="custom-card h-100 p-4">
                    <h5 class="fw-bold mb-4">Recent Records</h5>
                    <div class="vstack gap-3">
                        @forelse($recentRecords as $r)
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-4">
                                <div>
                                    <div class="fw-bold small text-dark">{{ $r->donor_name }}</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">
                                        {{ \Carbon\Carbon::parse($r->collected_date)->format('d M Y') }}
                                    </div>
                                </div>

                                @if($r->status == 'SUCCESSFUL')
                                    <span class="badge bg-success text-white border-0">Successful</span>
                                @else
                                    <span class="badge bg-warning text-dark border-0">Discarded</span>
                                @endif
                            </div>
                        @empty
                            <div class="text-center text-muted small py-4">
                                No records yet
                            </div>
                        @endforelse
                    </div>
                    <button class="btn btn-link text-danger text-decoration-none fw-bold text-uppercase w-100 mt-3"
                        style="font-size: 0.75rem; letter-spacing: 0.1em;" data-bs-toggle="modal"
                        data-bs-target="#historyModal">View Full History</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Record Result Modal -->
    <div class="modal fade" id="recordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Record Clinical Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" id="recordDonationForm">
                        @csrf
                        <!-- Record blood type -->


                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label>Hemoglobin</label>
                                <input type="number" step="0.1" min="8" max="20" class="form-control"
                                    name="hemoglobin_level" placeholder="e.g. 13.5" required>
                            </div>

                            <div class="col-6">
                                <label>Blood Pressure</label>
                                <input type="text" class="form-control" name="blood_pressure" placeholder="e.g. 120/80"
                                    pattern="^\d{2,3}\/\d{2,3}$" title="Format must be like 120/80" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Unit</label>
                            <input type="number" class="form-control" name="unit" value="1">
                        </div>

                        <div class="mb-4">
                            <label>Final Result</label>
                            <select class="form-select" name="donation_status">
                                <option value="SUCCESSFUL">Successful</option>
                                <option value="DISCARDED">Discarded</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes"></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">
                            Save Record
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Full History Modal (New Addition) -->
    <div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Donation History Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Simple Filters -->
                    <div class="d-flex gap-2 mb-3">
                        <input type="text" id="historySearch" class="form-control form-control-sm w-auto"
                            placeholder="Search Donor ID">
                        <select id="historyStatus" class="form-select form-select-sm w-auto">
                            <option value="all">All Results</option>
                            <option value="SUCCESSFUL">Successful</option>
                            <option value="DISCARDED">Discarded</option>
                        </select>
                    </div>

                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light sticky-top">
                                <tr>
                                    <th class="small fw-bold text-muted text-uppercase ps-3">Date</th>
                                    <th class="small fw-bold text-muted text-uppercase">Donor</th>
                                    <th class="small fw-bold text-muted text-uppercase">Type</th>
                                    <th class="small fw-bold text-muted text-uppercase">Vitals (Hb/BP)</th>
                                    <th class="small fw-bold text-muted text-uppercase text-end pe-3">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donationHistory as $r)
                                    <tr>
                                        <td class="small text-muted ps-3">
                                            {{ \Carbon\Carbon::parse($r->collected_date)->format('d M Y') }}
                                        </td>

                                        <td>
                                            <div class="fw-bold small">{{ $r->donor_name }}</div>
                                            <div class="small text-muted">ID: D-{{ $r->donor_id }}</div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $r->blood_type }}
                                            </span>
                                        </td>

                                        <td class="small">
                                            {{ $r->hemoglobin_level }} / {{ $r->blood_pressure }}
                                        </td>

                                        <td class="text-end pe-3">
                                            @if($r->status == 'SUCCESSFUL')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                                    Successful
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">
                                                    Discarded
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No donation records found
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="historyNoData" style="display: none;">
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No donation records found
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <form method="GET" action="{{ route('medical.exportDonationRecords') }}" class="d-inline">
                        <button type="submit" class="btn btn-outline-secondary rounded-pill fw-bold px-4">
                            <i class="fas fa-print me-2"></i> Print All Donation Log
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    document.getElementById('recordModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const appointmentId = button.getAttribute('data-appointment');

        const form = document.getElementById('recordDonationForm');
        form.action = "/medical_facilities/recordDonationResult/" + appointmentId;
    });

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('historySearch');
        const statusSelect = document.getElementById('historyStatus');
        const tbody = document.querySelector('#historyModal tbody');
        const noDataRow = document.getElementById('historyNoData');

        function filterHistory() {
            const searchValue = searchInput.value.trim().toLowerCase();
            const statusValue = statusSelect.value;

            let visibleCount = 0;

            const rows = tbody.querySelectorAll('tr:not(#historyNoData)');

            // 🔁 Reset everything first
            rows.forEach(row => row.style.display = '');

            rows.forEach(row => {
                const donorText = row.querySelector('td:nth-child(2)')?.innerText.toLowerCase() || '';
                const resultBadge = row.querySelector('td:last-child span')?.innerText.trim().toUpperCase() || '';

                const matchSearch = donorText.includes(searchValue);
                const matchStatus = (statusValue === 'all' || resultBadge === statusValue);

                const show = matchSearch && matchStatus;

                row.style.display = show ? '' : 'none';

                if (show) visibleCount++;
            });

            // 👇 Toggle "No Records"
            if (noDataRow) {
                noDataRow.style.display = (visibleCount === 0) ? '' : 'none';
            }
        }

        searchInput.addEventListener('input', filterHistory);
        statusSelect.addEventListener('change', filterHistory);
    });
</script>