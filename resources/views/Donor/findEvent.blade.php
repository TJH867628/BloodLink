<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Find Events</title>
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
            transition: transform 0.2s;
            overflow: hidden;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #D1FAE5;
            color: #047857;
        }

        .btn-primary-custom {
            background-color: var(--primary-red);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: 700;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #B91C1C;
            color: white;
        }

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
        }

        .width-20 {
            width: 20px;
            text-align: center;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="donor_dashboard.html">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="find_events.html">Find Events</a></li>
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
            <a href="/donor/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/donor/findEvent" class="nav-link active"><span class="nav-icon"><i class="fas fa-search w-25"></i></span> Find Events</a>
            <a href="/donor/history" class="nav-link"><span class="nav-icon"><i class="fas fa-history w-25"></i></span> My History</a>
            <a href="/donor/feedback" class="nav-link"><span class="nav-icon"><i class="fas fa-comment-dots w-25"></i></span> Feedback</a>
            <a href="/donor/profile" class="nav-link"><span class="nav-icon"><i class="fas fa-user-circle w-25"></i></span> Profile</a>
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
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-black mb-0">Find Events</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-success">Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div class="position-relative w-100 w-md-50" style="max-width: 400px;">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                <input type="text" id="eventSearch" class="form-control rounded-pill ps-5 py-2 border-0 shadow-sm" placeholder="Search Event...">
            </div>
        </div>

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
            @foreach($events as $event)
            <div class="col-md-6 col-xl-4 event-card" data-search="{{ strtolower($event->name . ' ' . $event->location) }}">
                <div class="custom-card h-100 d-flex flex-column">

                    <div class="bg-light p-4 d-flex justify-content-center align-items-center position-relative" style="height:160px; background: linear-gradient(135deg, #dc2626, #b91c1c);">
                        <i class="fas fa-hospital fa-3x text-white opacity-75"></i>

                        <span class="position-absolute top-0 end-0 m-3 status-badge 
                            {{ $event->status == 'ACTIVE' ? 'badge-success' : 'bg-secondary text-white' }}">
                            {{ $event->status }}
                        </span>
                    </div>


                    <div class="p-4 grow d-flex flex-column">
                        <h5 class="fw-bold mb-3">{{ $event->name }}</h5>

                        <div class="vstack gap-2 mb-4 text-secondary small fw-bold">
                            <div><i class="fas fa-map-marker-alt me-2 width-20"></i> {{ $event->location }}</div>
                            <div><i class="fas fa-calendar me-2 width-20"></i> {{ $event->date }}</div>
                            <div><i class="fas fa-clock me-2 width-20"></i> {{ $event->time }}</div>
                        </div>


                        <div class="mt-auto border-top pt-3 d-flex justify-content-between align-items-center">
                            <span class="text-label text-success">
                                {{ $event->available_slots }} Slots Left
                            </span>
                            @if($event->available_slots == 0 || $event->status != 'ACTIVE')
                            <button class="btn btn-secondary btn-sm" disabled>Closed</button>
                            @elseif(in_array($event->id, $bookedEventId))
                            <button class="btn btn-success btn-sm" disabled>Booked</button>
                            @elseif($donorHealthDetails && $donorHealthDetails->last_donation_date && \Carbon\Carbon::parse($event->date)->lt(\Carbon\Carbon::parse($donorHealthDetails->last_donation_date)->addMonths(3)))
                            <button class="btn btn-warning btn-sm" disabled>
                                Not Eligible
                            </button>
                            @elseif($lastAcceptedDate && \Carbon\Carbon::parse($event->date)->lt(\Carbon\Carbon::parse($lastAcceptedDate)->addMonths(3)))
                            <button class="btn btn-warning btn-sm" disabled>
                                Not Eligible
                            </button>
                            @elseif($event->status == 'ACTIVE' && $event->available_slots > 0)
                            <form method="POST" action="{{ route('donor.bookEvent', $event->id) }}">
                                @csrf
                                <button class="btn btn-primary-custom btn-sm">Book Visit</button>
                            </form>
                            @else
                            <button class="btn btn-secondary btn-sm" disabled>Closed</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($events->isEmpty())
        <div id="noResults" class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="fw-bold text-muted">No events found</h5>
            <p class="text-muted small">
                Try searching with a different keyword or location.
            </p>
        </div>
        @endif
        <div id="noResults" class="text-center py-5 d-none">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="fw-bold text-muted">No events found</h5>
            <p class="text-muted small">
                Try searching with a different keyword or location.
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.getElementById('eventSearch');
        const eventCards = document.querySelectorAll('.event-card');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            eventCards.forEach(card => {
                const text = card.dataset.search;

                if (text.includes(keyword)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show or hide empty message
            if (visibleCount === 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        });
    </script>
</body>

</html>