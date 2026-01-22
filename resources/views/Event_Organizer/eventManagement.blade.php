<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Event Management</title>
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

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        /* Navigation Styles */
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
            padding: 10px 16px;
            border: 2px solid #F1F5F9;
            background-color: #F8FAFC;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #FECACA;
            box-shadow: none;
            background-color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-white border-bottom mobile-nav d-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="brand-icon"><i class="fas fa-droplet"></i></div> <span class="fw-bold">BloodLink</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mobileMenu">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item"><a class="nav-link" href="/event_organizer.dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/event_organizer/eventManagement">Event Management</a></li>
                    <li class="nav-item"><a class="nav-link" href="/event_organizer/participation">Participation</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-none d-lg-flex">
        <div class="brand-section">
            <div class="brand-icon"><i class="fas fa-droplet fa-lg"></i></div><span class="fs-4 fw-bolder text-dark">BloodLink</span>
        </div>
        <nav class="nav flex-column mt-2 w-100">
            <div class="px-4 pb-2 text-label" style="font-size: 0.7rem; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Organizer Portal</div>
            <a href="/event_organizer/dashboard" class="nav-link"><span class="nav-icon"><i class="fas fa-chart-pie w-25"></i></span> Dashboard</a>
            <a href="/event_organizer/eventManagement" class="nav-link active"><span class="nav-icon"><i class="fas fa-calendar-alt w-25"></i></span> Event Management</a>
            <a href="/event_organizer/participation" class="nav-link"><span class="nav-icon"><i class="fas fa-users w-25"></i></span> Participation</a>
        </nav>
        <div class="mt-auto border-top p-3">
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">Organizer</div>
                        <div class="logout-text">Sign Out</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Event Management</h2>
                <p class="text-muted small fw-medium mt-1 mb-0">Create new blood drives or update existing details.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">Organizer</div>
                    <div class="text-label text-success" style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase;">Event Organizer</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer" class="rounded-3 border" width="40" height="40" alt="Avatar">
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

        <div class="custom-card">
            <div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Managed Events</h5>
                <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#eventModal"><i class="fas fa-plus me-2"></i> Create New Event</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Event Details</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Location</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Capacity</th>
                            <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="px-4 py-3 text-end text-muted small fw-bold text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                    @php
                        $used = $event->total_slots - $event->available_slots;
                        $percent = $event->total_slots > 0 ? ($used / $event->total_slots) * 100 : 0;
                    @endphp

                    <tr @if($event->status == 'COMPLETED') class="opacity-50" @endif>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark">{{ $event->name }}</div>
                            <div class="small text-muted">
                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }} • {{ $event->time }}
                            </div>
                        </td>

                        <td class="px-4 py-3 text-muted fw-medium">
                            <i class="fas fa-map-pin me-1 text-danger"></i> {{ $event->location }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px; width: 100px;">
                                    <div class="progress-bar
                                        @if($percent > 70) bg-danger
                                        @elseif($percent > 40) bg-warning
                                        @else bg-primary @endif"
                                        style="width: {{ $percent }}%">
                                    </div>
                                </div>
                                <span class="small fw-bold">{{ $used }}/{{ $event->total_slots }}</span>
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            @if($event->status == 'ACTIVE')
                                <span class="badge bg-success-subtle text-success rounded-pill">Active</span>
                            @elseif($event->status == 'FULL')
                                <span class="badge bg-warning-subtle text-warning rounded-pill">Full</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Completed</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-end">
                            @if($event->status != 'COMPLETED')
                                <button class="btn btn-light btn-sm text-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editEventModal"
                                    data-id="{{ $event->id }}"
                                    data-name="{{ $event->name }}"
                                    data-date="{{ $event->date }}"
                                    data-time="{{ $event->time }}"
                                    data-location="{{ $event->location }}"
                                    data-slots="{{ $event->total_slots }}"
                                    data-description="{{ $event->details }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="/event_organizer/deleteEvent/{{ $event->id }}" method="POST" style="display:inline" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-sm text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-light btn-sm text-secondary" disabled>
                                    <i class="fas fa-lock"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold">Create Donation Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="post" action="{{ route('event_organizer.createEvent') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Event Name</label>
                            <input type="text" class="form-control" name="event_name" placeholder="e.g. City Mall Blood Drive">
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Venue / Location</label>
                            <input type="text" class="form-control"  name="location" placeholder="e.g. Main Atrium">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Date</label>
                                <input type="date"  name="event_date" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Time</label>
                                <input type="time"  name="event_time" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Maximum Donors</label>
                            <input type="number" class="form-control" name="total_slots" placeholder="e.g. 50">
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal (New Addition) -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold text-dark">Update Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form method="post" id="editEventForm">
                        @csrf
                        <div class="alert alert-light border border-secondary-subtle d-flex align-items-center mb-4 rounded-3 p-3">
                            <i class="fas fa-info-circle text-primary me-3 fs-5"></i>
                            <div class="small text-muted lh-sm">
                                Changes to date or venue will automatically notify all <strong>registered donors</strong> via notification page.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Event Name</label>
                            <input type="text" class="form-control fw-bold" name="event_name" value="Red Cross Annual Drive">
                        </div>
                        <div class="mb-3">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Venue / Location</label>
                            <input type="text" class="form-control" name="location" value="City Hall, Main Wing">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Date</label>
                                <input type="date" class="form-control" name="event_date" value="2026-01-10">
                            </div>
                            <div class="col-6">
                                <label class="text-muted fw-bold small text-uppercase mb-1">Time</label>
                                <input type="time" class="form-control" name="event_time" value="09:00">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted fw-bold small text-uppercase mb-1">Maximum Donors</label>
                            <input type="number" class="form-control" name="total_slots" value="50">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-light w-50 py-3 rounded-pill fw-bold border" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark w-50 py-3 rounded-pill fw-bold shadow-sm" data-bs-dismiss="modal">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script>
document.getElementById('editEventModal').addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;

    let id = button.getAttribute('data-id');
    let name = button.getAttribute('data-name');
    let date = button.getAttribute('data-date');
    let time = button.getAttribute('data-time');
    let location = button.getAttribute('data-location');
    let slots = button.getAttribute('data-slots');
    let description = button.getAttribute('data-description');

    let form = document.getElementById('editEventForm');
    console.log(form);
    form.action = "/event_organizer/editEvent/" + id;

    // Fill the inputs
    form.querySelector('[name="event_name"]').value = name;
    form.querySelector('[name="event_date"]').value = date;
    form.querySelector('[name="event_time"]').value = time;
    form.querySelector('[name="location"]').value = location;
    form.querySelector('[name="total_slots"]').value = slots;
    form.querySelector('[name="description"]').value = description ?? '';
});

function confirmDelete(e) {
    e.preventDefault();   // stop form submission

    if (confirm("! Are you sure you want to delete this event?\nThis action cannot be undone.")) {
        e.target.submit();   // user clicked OK → submit
    }

    return false; // cancel if user clicks Cancel
}
</script>