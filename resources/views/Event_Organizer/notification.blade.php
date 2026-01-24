<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Notifications</title>
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

        /* Sidebar (Standard Layout) */
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

        /* Utility */
        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94A3B8;
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

        /* Notification Specific Styles */
        .notification-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .notification-card.unread {
            background-color: white;
            border-left: 4px solid var(--primary-red);
        }

        .notification-card.read {
            background-color: #F1F5F9;
            /* Light gray background for read items */
            border-left: 4px solid transparent;
            opacity: 0.85;
        }

        .notification-card.read .notif-title {
            color: var(--text-muted);
            font-weight: 600;
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .bg-urgent {
            background-color: #FEF2F2;
            color: #DC2626;
        }

        .bg-info-custom {
            background-color: #EFF6FF;
            color: #2563EB;
        }

        .bg-success-custom {
            background-color: #ECFDF5;
            color: #059669;
        }

        .time-badge {
            font-size: 0.75rem;
            color: #94A3B8;
            font-weight: 600;
        }

        .unread-dot {
            width: 10px;
            height: 10px;
            background-color: var(--primary-red);
            border-radius: 50%;
            display: inline-block;
            margin-left: 8px;
        }

        .action-bar {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
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
                    <li class="nav-item"><a class="nav-link active" href="notifications.html">Notifications</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar (Example using Donor Context) -->
    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label">Organizer Portal</div>
            <a href="/event_organizer/dashboard" class="nav-link active"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/event_organizer/eventManagement" class="nav-link"><span class="nav-icon"><i class="fas fa-calendar-alt w-25"></i></span> Event Management</a>
            <a href="/event_organizer/participation" class="nav-link"><span class="nav-icon"><i class="fas fa-users w-25"></i></span> Participation</a>
            <a href="/event_organizer/profile" class="nav-link"><span class="nav-icon"><i class="fas fa-id-card"></i></span> Profile</a>
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
        <header class="mb-5">
            <h2 class="fw-black mb-0">Notifications</h2>
            <p class="text-muted small fw-medium mt-1">Manage your alerts and system messages.</p>
        </header>
        <!-- Action Bar -->
        <div class="action-bar shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold text-dark">Filter:</span>
                <select class="form-select form-select-sm rounded-pill border-secondary-subtle" style="width: 150px;">
                    <option value="all">All Notifications</option>
                    <option value="unread">Unread Only</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <form method="POST" action="{{ route('donor.markAllNotificationsRead') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-secondary w-100 mb-2">
                        Mark All as Read
                    </button>
                </form>
            </div>
        </div>

        <div id="notificationList">
        @forelse($notifications as $notif)
        <div class="notification-card {{ $notif->status == 'SEND' ? 'unread' : 'read' }} d-flex gap-3 align-items-start"
            id="notif-{{ $notif->id }}">

            <!-- ICON -->
            <div class="icon-circle 
                @if(str_contains(strtolower($notif->message), 'urgent') || str_contains(strtolower($notif->message), 'emergency'))
                    bg-urgent
                @elseif(str_contains(strtolower($notif->message), 'appointment'))
                    bg-info-custom
                @else
                    bg-success-custom
                @endif
            ">
                @if(str_contains(strtolower($notif->message), 'urgent') || str_contains(strtolower($notif->message), 'emergency'))
                    <i class="fas fa-exclamation-circle"></i>
                @elseif(str_contains(strtolower($notif->message), 'appointment'))
                    <i class="fas fa-calendar-check"></i>
                @else
                    <i class="fas fa-clipboard-check"></i>
                @endif
            </div>

            <!-- CONTENT -->
            <div class="grow">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="fw-bold mb-0 text-dark notif-title">
                        {{ Str::limit($notif->message, 40) }}
                        @if($notif->status == 'SEND')
                            <span class="unread-dot"></span>
                        @endif
                    </h6>
                    <span class="time-badge">
                        {{ \Carbon\Carbon::parse($notif->datetime)->diffForHumans() }}
                    </span>
                </div>

                <p class="text-muted small mb-0 lh-sm">
                    {{ $notif->message }}
                </p>
            </div>

            <!-- ACTIONS -->
            <div class="dropdown">
                <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                    @if($notif->status == 'SEND')
                    <li>
                        <form method="POST" 
                            action="{{ route('donor.markNotificationRead', $notif->id) }}">
                            @csrf
                            <button type="submit" class="dropdown-item small fw-bold">
                                Mark as read
                            </button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
        @empty
            <div class="text-center text-muted py-5">
                No notifications yet
            </div>
        @endforelse

        </div>

        <!-- Empty State (Hidden by default) -->
        <div id="emptyState" class="text-center py-5 d-none">
            <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                <i class="fas fa-bell-slash fa-2x text-muted opacity-50"></i>
            </div>
            <h5 class="fw-bold text-muted">No notifications</h5>
            <p class="small text-muted">You're all caught up!</p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to mark a single notification as read
        function markRead(id) {
            const card = document.getElementById(id);
            if (card) {
                card.classList.remove('unread');
                card.classList.add('read');
                // Remove the red dot if it exists
                const dot = card.querySelector('.unread-dot');
                if (dot) dot.remove();
            }
        }

        // Function to delete a single notification
        function deleteNotif(id) {
            const card = document.getElementById(id);
            if (card) {
                // Add fade out effect
                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                card.style.opacity = '0';
                card.style.transform = 'translateX(20px)';

                setTimeout(() => {
                    card.remove();
                    checkEmpty();
                }, 300);
            }
        }

        // Function to mark ALL as read
        function markAllAsRead() {
            const unreadItems = document.querySelectorAll('.notification-card.unread');
            unreadItems.forEach(card => {
                card.classList.remove('unread');
                card.classList.add('read');
                const dot = card.querySelector('.unread-dot');
                if (dot) dot.remove();
            });
        }

        // Function to Delete ALL
        function deleteAll() {
            if (confirm("Are you sure you want to clear all notifications?")) {
                const list = document.getElementById('notificationList');
                list.innerHTML = '';
                checkEmpty();
            }
        }

        // Check if list is empty to show empty state
        function checkEmpty() {
            const list = document.getElementById('notificationList');
            const emptyState = document.getElementById('emptyState');
            if (list.children.length === 0) {
                emptyState.classList.remove('d-none');
            }
        }
    </script>
</body>
</html>