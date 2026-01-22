<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Submit Feedback</title>
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
            width: 32px;              /* FIXED WIDTH */
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

        .feedback-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .custom-card {
            border: 1px solid #E2E8F0;
            border-radius: 24px;
            background: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .rating-stars {
            display: flex;
            gap: 10px;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            cursor: pointer;
            font-size: 2rem;
            color: #CBD5E1;
            transition: color 0.2s;
        }

        .rating-stars input:checked~label,
        .rating-stars label:hover,
        .rating-stars label:hover~label {
            color: #F59E0B;
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

        .btn-submit {
            background-color: var(--primary-red);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background-color: #B91C1C;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }

        .text-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.05em;
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
                    <li class="nav-item"><a class="nav-link" href="find_events.html">Find Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_history.html">My History</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-danger" href="feedback.html">Feedback</a></li>
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
            <a href="/donor/dashboard" class="nav-link">
                <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                Dashboard
            </a>
            <a href="/donor/findEvent" class="nav-link">
                <span class="nav-icon"><i class="fas fa-search"></i></span>
                Find Events
            </a>
            <a href="/donor/history" class="nav-link">
                <span class="nav-icon"><i class="fas fa-history"></i></span>
                My History
            </a>
            <a href="/donor/feedback" class="nav-link active">
                <span class="nav-icon"><i class="fas fa-comment-dots"></i></span>
                Feedback
            </a>
            <a href="/donor/profile" class="nav-link">
                <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
                Profile
            </a>
        </nav>
        <div class="mt-auto border-top p-3">
<<<<<<< Updated upstream
            <a href="/logout" class="logout-link">
                <div class="d-flex align-items-center gap-3 p-2 rounded logout-item">
                    <div class="icon-box">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="logout-text">Sign Out</div>
=======
            <a href="/logout" style="text-decoration:none">
                <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light">
                    <div class="bg-light rounded-3 p-2 text-secondary"><i class="fas fa-sign-out-alt"></i></div>
                    <div>
                        <div class="fw-bold text-dark small">{{ $user->name }}</div>
                        <div class="text-label text-danger" style="cursor:pointer">Sign Out</div>
>>>>>>> Stashed changes
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-black mb-0">Share Your Experience</h2>
                <p class="text-muted small fw-medium mt-1">Your feedback helps us improve the donation process.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold small">{{ $user->name }}</div>
                    <div class="text-label text-success">Donor</div>
                </div>
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Donor" class="rounded-3 border" width="40" height="40" alt="Avatar">
            </div>
        </header>

        <div class="feedback-container">
            <div class="custom-card p-4 p-md-5">
                <form id="feedbackForm" method="POST" action="{{ route('donor.submitFeedback') }}">
                    @csrf
                    <!-- Event Selection -->
                    <div class="mb-4">
                        <label class="text-label mb-2 d-block">Select Donation Event</label>
<<<<<<< Updated upstream
                        <select name="donation_id" class="form-select">
=======
                        <select name="donation_id" class="form-select" required>
>>>>>>> Stashed changes
                            <option value="" disabled selected>Choose a recent visit...</option>

                            @foreach($donations as $donation)
                                <option value="{{ $donation->id }}">
                                    {{ $donation->event_name }} 
                                    ({{ $donation->facility_name ?? 'Medical Facility' }}, 
                                    {{ $donation->created_at->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>

                        <div class="form-text mt-2">Only completed donations are shown here.</div>
                    </div>

                    <!-- Rating -->
                    <div class="mb-4">
                        <label class="text-label mb-2 d-block">Overall Rating</label>
                        <div class="rating-stars">
                            <input type="radio" name="rating" value="5" id="5"><label for="5">★</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">★</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">★</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">★</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">★</label>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="mb-4">
                        <label class="text-label mb-2 d-block">Your Comments</label>
                        <textarea class="form-control" name="comments" rows="5" placeholder="Tell us about the facility, staff, or any suggestions you have..." required></textarea>
                    </div>
                    {{-- Success message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Error message --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Validation errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Submit -->
                    <button type="submit" class="btn btn-submit">
                        Submit Feedback <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </form>
            </div>

            <!-- Impact Info -->
            <div class="mt-4 p-4 rounded-4 bg-primary-subtle border border-primary-subtle d-flex gap-3 align-items-start">
                <div class="text-primary mt-1"><i class="fas fa-info-circle"></i></div>
                <div class="small fw-medium text-primary-emphasis">
                    As per our safety guidelines, if you experienced any adverse health effects after your donation, please contact the clinic directly at <strong>+60 1234 56789</strong>.
                </div>
            </div>

            {{-- Feedback History --}}
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Your Feedback History</h4>

                @if($feedbacks->count())
                    <div class="vstack gap-3">
                        @foreach($feedbacks as $fb)
                            <div class="p-4 bg-white border rounded-4 shadow-sm">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Feedback</strong>
                                    <small class="text-muted">
                                        {{ $fb->created_at->format('d M Y, h:i A') }}
                                    </small>
                                </div>

                                <p class="mb-0 text-secondary" style="white-space: pre-line;">
                                    {{ $fb->message }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 bg-light border rounded-4 text-center text-muted">
                        <i class="fas fa-comment-slash fa-2x mb-2"></i>
                        <div class="fw-bold">No feedback submitted yet</div>
                        <small>Your submitted feedback will appear here.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 24px;">
                <div class="modal-body text-center p-5">
                    <div class="bg-success-subtle text-success rounded-circle d-inline-flex p-4 mb-4">
                        <i class="fas fa-check fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-2">Thank You!</h3>
                    <p class="text-muted mb-4">Your feedback has been successfully submitted and linked to your donation record.</p>
                    <button type="button" class="btn btn-dark w-100 py-3 rounded-pill fw-bold" data-bs-dismiss="modal">Back to Dashboard</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>