<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLink - Connect. Donate. Save Lives.</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-red: #dc2626; 
            --brand-red-light: #fef2f2;
            --brand-dark: #0f172a; 
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155; /* Slate-700 */
        }

        .text-brand { color: var(--brand-red); }
        .bg-brand { background-color: var(--brand-red); }
        .bg-brand-light { background-color: var(--brand-red-light); }
        
        .fw-black { font-weight: 800; }
        
        .rounded-4xl { border-radius: 2rem !important; }
        .rounded-3xl { border-radius: 1.5rem !important; }
        
        .btn-brand {
            background-color: var(--brand-dark);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 1rem;
            font-weight: 800;
            transition: all 0.2s;
            border: none;
        }
        .btn-brand:hover {
            background-color: #1e293b;
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 2px solid #e2e8f0;
            color: #475569;
            padding: 0.8rem 2rem;
            border-radius: 1rem;
            font-weight: 700;
            background: white;
        }
        .btn-outline-custom:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .nav-link {
            font-weight: 700;
            color: #64748b;
            font-size: 0.9rem;
        }
        .nav-link:hover { color: var(--brand-red); }

        .inventory-card {
            border: 1px solid #e2e8f0;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            background: white;
            position: relative;
            z-index: 10;
        }
        
        .deco-blob {
            position: absolute;
            background-color: #fee2e2;
            border-radius: 40px;
            inset: -15px;
            transform: rotate(3deg);
            z-index: 0;
            transition: transform 0.3s ease;
        }
        .inventory-wrapper:hover .deco-blob {
            transform: rotate(1deg);
        }

        .blood-type-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
        }

        .progress-slim {
            height: 6px;
            border-radius: 10px;
            background-color: #e2e8f0;
        }

        .step-icon-box {
            width: 80px;
            height: 80px;
            background-color: #1e293b;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin: 0 auto 1.5rem auto;
            border: 1px solid #334155;
            transition: background-color 0.3s;
        }
        .step-card:hover .step-icon-box {
            background-color: var(--brand-red);
            border-color: var(--brand-red);
        }

        .event-card {
            border: 1px solid #e2e8f0;
            border-radius: 2rem;
            transition: all 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
            border-color: var(--brand-red-light);
        }
    </style>
</head>
<body class="bg-white">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white/95 border-bottom py-3" style="backdrop-filter: blur(10px); background-color: rgba(255,255,255,0.9);">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <div class="bg-brand p-2 rounded-3 shadow-sm">
                    <i class="bi bi-droplet-fill text-white fs-5"></i>
                </div>
                <span class="fw-black text-dark fs-4 tracking-tight">BloodLink</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-lg-4">
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How it Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                </ul>
                <div class="d-flex gap-3 align-items-center mt-3 mt-lg-0">
                    <a href="/login" class="text-decoration-none fw-bold text-secondary px-2">Log In</a>
                    <a href="/register" class="btn btn-danger rounded-3 fw-bold px-4 shadow-sm">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-5 mt-5 pb-5 mb-5">
        <div class="container px-4 px-lg-5 pt-5">
            <div class="row align-items-center gy-5">
                <!-- Left Content -->
                <div class="col-lg-6">
                    <div class="d-inline-flex align-items-center gap-2 bg-brand-light text-brand px-3 py-1 rounded-pill fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
                        <i class="bi bi-activity"></i>
                        <span>Connecting Lives Across the Nation</span>
                    </div>
                    
                    <h1 class="display-3 fw-black text-dark mt-4 mb-3 lh-1">
                        Be a Hero.<br>
                        <span class="text-brand text-decoration-underline">Save a Life.</span>
                    </h1>
                    
                    <p class="lead text-secondary fw-medium mb-5" style="max-width: 500px;">
                        BloodLink is a unified platform connecting donors, hospitals, and event organizers. We streamline the donation process to ensure blood reaches those in need, faster.
                    </p>
                    
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('login') }}" class="btn btn-brand d-flex align-items-center justify-content-center gap-2 shadow-lg">
                            <i class="bi bi-heart-fill"></i>
                            Start Donating Now
                        </a>
                        <button class="btn btn-outline-custom">
                            <a class="text-decoration-none text-dark" href="#how-it-works">How it Works</a>
                        </button>
                    </div>
                </div>

                <!-- Right Visual (Inventory Widget) -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="position-relative p-4 inventory-wrapper" style="max-width: 500px; margin-left: auto;">
                        <div class="deco-blob"></div>
                        
                        <!-- Main Card -->
                        <div class="inventory-card rounded-4xl p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="fw-black m-0 text-dark h5">Live Inventory</h3>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.7rem;">Optimal</span>
                            </div>

                            <!-- Inventory Items -->
                            <div class="d-flex flex-column gap-3">
                                <!-- Item 1 -->
                                <div class="p-3 bg-light rounded-4 border d-flex align-items-center gap-3">
                                    <div class="blood-type-box bg-danger">O-</div>
                                    <div class="grow">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-uppercase text-secondary fw-bold" style="font-size: 0.7rem;">Current Stock</span>
                                            <span class="fw-bold text-dark" style="font-size: 0.8rem;">92%</span>
                                        </div>
                                        <div class="progress progress-slim">
                                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 92%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="p-3 bg-light rounded-4 border d-flex align-items-center gap-3">
                                    <div class="blood-type-box bg-dark">A+</div>
                                    <div class="grow">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-uppercase text-secondary fw-bold" style="font-size: 0.7rem;">Current Stock</span>
                                            <span class="fw-bold text-dark" style="font-size: 0.8rem;">65%</span>
                                        </div>
                                        <div class="progress progress-slim">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="p-3 bg-light rounded-4 border d-flex align-items-center gap-3">
                                    <div class="blood-type-box bg-dark">B-</div>
                                    <div class="grow">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-uppercase text-secondary fw-bold" style="font-size: 0.7rem;">Current Stock</span>
                                            <span class="fw-bold text-dark" style="font-size: 0.8rem;">48%</span>
                                        </div>
                                        <div class="progress progress-slim">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 48%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-brand-dark text-white" style="background-color: var(--brand-dark)">
        <div class="container px-4 px-lg-5 py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="display-5 fw-black mb-3">How the System Works</h2>
                <p class="text-secondary lead fs-6">Streamlining the journey from donor registration to clinical supply.</p>
            </div>

            <div class="row g-4 text-center">
                <!-- Step 1 -->
                <div class="col-md-6 col-lg-3 step-card">
                    <div class="step-icon-box">
                        <i class="bi bi-phone fs-2"></i>
                    </div>
                    <h3 class="h5 fw-black mb-3">01. Register</h3>
                    <p class="text-secondary small px-3">Create your donor account and provide essential health details securely.</p>
                </div>

                <!-- Step 2 -->
                <div class="col-md-6 col-lg-3 step-card">
                    <div class="step-icon-box">
                        <i class="bi bi-search fs-2"></i>
                    </div>
                    <h3 class="h5 fw-black mb-3">02. Find Event</h3>
                    <p class="text-secondary small px-3">Browse local blood drives near you and book a convenient time slot.</p>
                </div>

                <!-- Step 3 -->
                <div class="col-md-6 col-lg-3 step-card">
                    <div class="step-icon-box">
                        <i class="bi bi-droplet fs-2"></i>
                    </div>
                    <h3 class="h5 fw-black mb-3">03. Donate</h3>
                    <p class="text-secondary small px-3">Visit the clinic or event location for screening and safe collection.</p>
                </div>

                <!-- Step 4 -->
                <div class="col-md-6 col-lg-3 step-card">
                    <div class="step-icon-box">
                        <i class="bi bi-bar-chart fs-2"></i>
                    </div>
                    <h3 class="h5 fw-black mb-3">04. Impact</h3>
                    <p class="text-secondary small px-3">Monitor where your donation goes and view your health results.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="py-5 bg-white">
        <div class="container px-4 px-lg-5 py-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5">
                <div class="mb-3 mb-md-0">
                    <h2 class="display-5 fw-black mb-2 text-dark">Upcoming Drives</h2>
                    <p class="text-secondary lead fs-6 mb-0">Join a donation event near you and make a difference.</p>
                </div>
                <a href="{{ route('login') }}" class="btn btn-outline-custom">View All Events</a>
            </div>

            <div class="row g-4">
                <!-- Event Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="event-card h-100 bg-white p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="bg-brand-light text-brand p-3 rounded-3">
                                <i class="bi bi-calendar-heart fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill text-uppercase fw-bold" style="font-size: 0.7rem;">Active</span>
                        </div>
                        
                        <h4 class="fw-black mb-3 text-dark">Red Cross Annual Drive</h4>
                        
                        <div class="d-flex flex-column gap-3 text-secondary mb-4 grow">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-clock text-brand"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">Jan 10, 2026 • 09:00 - 17:00</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-geo-alt text-brand"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">City Hall Main Hall</span>
                            </div>
                        </div>

                        <div class="pt-4 border-top mt-auto d-flex align-items-center justify-content-between">
                            <span class="text-brand fw-black text-uppercase" style="font-size: 0.75rem;">12 Slots Remaining</span>
                            <a href="{{ route('login') }}" class="btn btn-brand py-2 px-4 rounded-3 text-sm">Book</a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="event-card h-100 bg-white p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="bg-brand-light text-brand p-3 rounded-3">
                                <i class="bi bi-hospital fs-4"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill text-uppercase fw-bold" style="font-size: 0.7rem;">Active</span>
                        </div>
                        
                        <h4 class="fw-black mb-3 text-dark">Community Health Fair</h4>
                        
                        <div class="d-flex flex-column gap-3 text-secondary mb-4 grow">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-clock text-brand"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">Jan 15, 2026 • 10:00 - 15:00</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-geo-alt text-brand"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">Downtown Plaza</span>
                            </div>
                        </div>

                        <div class="pt-4 border-top mt-auto d-flex align-items-center justify-content-between">
                            <span class="text-brand fw-black text-uppercase" style="font-size: 0.75rem;">30 Slots Remaining</span>
                            <a href="{{ route('login') }}" class="btn btn-brand py-2 px-4 rounded-3 text-sm">Book</a>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="event-card h-100 bg-white p-4 d-flex flex-column opacity-75">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="bg-secondary bg-opacity-10 text-secondary p-3 rounded-3">
                                <i class="bi bi-buildings fs-4"></i>
                            </div>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill text-uppercase fw-bold" style="font-size: 0.7rem;">Completed</span>
                        </div>
                        
                        <h4 class="fw-black mb-3 text-dark">University Donation Day</h4>
                        
                        <div class="d-flex flex-column gap-3 text-secondary mb-4 grow">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-clock"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">Dec 20, 2025 • 08:00 - 16:00</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-geo-alt"></i>
                                <span class="fw-bold" style="font-size: 0.9rem;">Campus Gymnasium</span>
                            </div>
                        </div>

                        <div class="pt-4 border-top mt-auto d-flex align-items-center justify-content-between">
                            <span class="text-secondary fw-black text-uppercase" style="font-size: 0.75rem;">Full Capacity</span>
                            <button class="btn btn-outline-secondary py-2 px-4 rounded-3 text-sm" disabled>Closed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5 bg-brand-light">
        <div class="container px-4 px-lg-5 py-5">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="d-inline-flex align-items-center gap-2 bg-white text-dark border px-3 py-1 rounded-pill fw-bold text-uppercase mb-4" style="font-size: 0.75rem; letter-spacing: 1px;">
                        <i class="bi bi-people-fill text-brand"></i>
                        <span>Who We Are</span>
                    </div>
                    <h2 class="display-4 fw-black mb-4 text-dark">Bridging the Gap Between <span class="text-brand">Need</span> and <span class="text-brand">Goodwill</span>.</h2>
                    <p class="lead text-secondary mb-4">
                        BloodLink was founded on a simple premise: blood shortages are often a logistics problem, not a supply problem.
                    </p>
                    <p class="text-secondary mb-5">
                        By digitizing the donation supply chain, we empower hospitals to manage inventory efficiently, enable organizers to run smoother drives, and give donors the transparency they deserve.
                    </p>

                    <div class="row g-4">
                        <div class="col-4">
                            <h3 class="fw-black text-brand display-6 mb-1">12k+</h3>
                            <p class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Active Donors</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-black text-brand display-6 mb-1">50+</h3>
                            <p class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Partner Hospitals</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-black text-brand display-6 mb-1">100%</h3>
                            <p class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Secure Data</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white p-5 rounded-4xl shadow-sm border position-relative overflow-hidden">
                        <i class="bi bi-quote position-absolute text-brand opacity-10" style="font-size: 10rem; top: -2rem; left: 1rem;"></i>
                        <div class="position-relative">
                            <h4 class="fw-bold mb-4">Our Vision</h4>
                            <p class="text-secondary fs-5 lh-base mb-0">
                                "We envision a world where no surgery is postponed and no life is lost simply because the right blood type wasn't available at the right time. BloodLink is the infrastructure for that future."
                            </p>
                            <div class="d-flex align-items-center gap-3 mt-4 pt-4 border-top">
                                <div class="bg-brand text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">TJ</div>
                                <div>
                                    <p class="fw-black text-dark mb-0">Tan Jing Heng</p>
                                    <p class="text-secondary small mb-0">Co-Founder & Lead Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-5 border-top">
        <div class="container text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                <div class="bg-brand p-2 rounded-3 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-droplet-fill text-white"></i>
                </div>
                <span class="fw-black text-dark fs-4 tracking-tight">BloodLink</span>
            </div>
            <p class="text-secondary text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 2px;">
                &copy; 2025 BloodLink Unified Suite. All Rights Reserved.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>