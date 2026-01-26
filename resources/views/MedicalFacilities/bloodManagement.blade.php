<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Blood Management</title>
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
            height: 100%;
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
    </style>
</head>

<body>

    <!-- Mobile Nav -->
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
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/inventory">Inventory &
                            Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/medical_facilities/donationManagement">Donation
                            Management</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger"
                            href="hospital_blood_logistics.html">Blood Logistics</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
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
            <a href="/medical_facilities/donationManagement" class="nav-link"><i class="fas fa-user-nurse w-25"></i>
                Donation Management</a>
            <a href="/medical_facilities/bloodManagement" class="nav-link active"><i
                    class="fas fa-exchange-alt w-25"></i> Blood Management</a>
            <a href="/medical_facilities/profile" class="nav-link"><i class="fas fa-hospital w-25"></i> Profile</a>
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

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Blood Management</h2>
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

        <div class="row mt-4">
            <div class="col-12">
                <div class="custom-card">
                    <div class="p-4 border-bottom bg-light">
                        <h5 class="fw-bold mb-0">Recent Logistics Activity</h5>
                    </div>
                    <div class="p-3 border-bottom bg-white">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <select name="blood_type" class="form-select">
                                    <option value="">All Blood Types</option>
                                    @foreach(['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-'] as $type)
                                        <option value="{{ $type }}" {{ request('blood_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="number" name="bag_id" class="form-control" placeholder="Blood Bag ID"
                                    value="{{ request('bag_id') }}">
                            </div>

                            <div class="col-md-3">
                                <select name="sort" class="form-select">
                                    <option value="">Sort by</option>
                                    <option value="expiry" {{ request('sort') == 'expiry' ? 'selected' : '' }}>Expiry
                                        Soonest</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-1 d-grid">
                                <button class="btn btn-danger fw-bold">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Action</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Blood Bag Id</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Blood Type</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Details</th>
                                    <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Donor</th>
                                </tr>
                            </thead>
                            <form method="POST" action="{{ route('medical_facilities.useBloodBags') }}">
                                @csrf

                                <tbody>
                                    @foreach($bloodBags as $bag)
                                        <tr>
                                            <td class="px-4 fw-bold text-dark">
                                                <input type="checkbox" name="blood_bag_ids[]" value="{{ $bag->id }}"
                                                    class="form-check-input">
                                                <span class="small fw-bold text-muted">Use this bag</span>
                                            </td>

                                            <td class="px-4 text-muted small">
                                                {{ str_pad($bag->id, 5, '0', STR_PAD_LEFT) }}
                                            </td>

                                            <td class="px-4 fw-bold">{{ $bag->blood_type }}</td>

                                            <td class="px-4 small text-muted">
                                                Expires {{ \Carbon\Carbon::parse($bag->expires_at)->format('d M Y') }}
                                            </td>

                                            <td class="px-4 text-end small fw-bold">
                                                From Donation #{{ $bag->donation_record_id }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>

                        <div class="p-3 border-top bg-light d-flex justify-content-between align-items-center">
                            <div class="px-4 text-muted small">
                                Showing {{ $bloodBags->firstItem() }}–{{ $bloodBags->lastItem() }}
                                of {{ $bloodBags->total() }} blood bags
                            </div>
                            <div>
                                {{ $bloodBags->links('pagination::bootstrap-5') }}
                            </div>

                            <button class="btn btn-danger rounded-pill fw-bold px-4 shadow-sm">
                                <i class="fas fa-check me-1"></i> Confirm Usage
                            </button>
                        </div>
                        </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-card mt-5" id="history-table">
            <div class="p-4 border-bottom bg-light">
                <h5 class="fw-bold mb-0">Usage & Expiry History</h5>
                <p class="text-muted small mb-0">Used and expired blood bags</p>
            </div>
            <form method="GET" class="row g-3 p-3 border-bottom bg-white">

                <div class="col-md-4">
                    <select name="history_status" class="form-select">
                        <option value="">All (Used & Expired)</option>
                        <option value="USED" {{ request('history_status') == 'USED' ? 'selected' : '' }}>
                            Used
                        </option>
                        <option value="EXPIRED" {{ request('history_status') == 'EXPIRED' ? 'selected' : '' }}>
                            Expired
                        </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <input type="number" name="history_bag_id" class="form-control" placeholder="Search Blood Bag ID"
                        value="{{ request('history_bag_id') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary fw-bold">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                </div>

            </form>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Blood Bag</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Type</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Date</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Donation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $bag)
                            <tr class="{{ $bag->status == 'EXPIRED' }}">
                                <td class="px-4 fw-bold">
                                    {{ str_pad($bag->id, 5, '0', STR_PAD_LEFT) }}
                                </td>

                                <td class="px-4 fw-bold">
                                    {{ $bag->blood_type }}
                                </td>

                                <td class="px-4 fw-bold">
                                    @if($bag->status == 'EXPIRED')
                                        <span class="badge bg-danger">Expired</span>
                                    @else
                                        <span class="badge bg-secondary">Used</span>
                                    @endif
                                </td>

                                <td class="px-4 text-muted small">
                                    @if($bag->status == 'USED')
                                        Used on {{ \Carbon\Carbon::parse($bag->used_at)->format('d M Y, h:i A') }}
                                    @else
                                        Expired on {{ \Carbon\Carbon::parse($bag->expires_at)->format('d M Y') }}
                                    @endif
                                </td>

                                <td class="px-4 text-end fw-bold small">
                                    #{{ $bag->donation_record_id }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No usage or expiry records yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top bg-light d-flex justify-content-end">
                {{ $history->appends(request()->query())->fragment('history-table')->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>