<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BloodLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-red: #dc2626;
            --brand-dark: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .fw-black { font-weight: 800; }
        .text-brand { color: var(--brand-red); }
        .bg-brand { background: var(--brand-red); }

        .back-home-btn {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #ffffff;
            color: #475569;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            z-index: 10;
        }

        .back-home-btn:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
            transform: translateX(-3px);
        }

        .back-home-btn i {
            transition: transform 0.2s ease;
        }

        .back-home-btn:hover i {
            transform: translateX(-3px);
        }

        .btn-brand {
            background: var(--brand-dark);
            color: white;
            padding: 0.9rem;
            border-radius: 1rem;
            font-weight: 800;
            border: none;
        }

        .btn-brand:hover {
            background: #1e293b;
            color: #fff;
            transition: transform 0.2s ease;
            transform: translateY(-3px);
        }

        .auth-left {
            background: var(--brand-red);
            min-height: 100vh;
            color: white;
        }

        .auth-blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: #ef4444;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            top: -50px;
            right: -50px;
        }

        .form-control-custom {
            padding: 1rem 1rem 1rem 3rem;
            border-radius: 1rem;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            font-weight: 600;
        }

        .form-control-custom:focus {
            border-color: #fee2e2;
            box-shadow: 0 0 0 4px #fef2f2;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
        }
    </style>
</head>

<body class="d-flex flex-column flex-lg-row min-vh-100">
    <!-- LEFT SIDE -->
    <div class="col-lg-6 auth-left p-5 d-flex flex-column justify-content-between position-relative">
        <div class="auth-blob"></div>

        <div>
            <a href="/" class="text-white text-decoration-none d-flex align-items-center gap-2">
                <div class="bg-white p-2 rounded-3">
                    <i class="bi bi-droplet-fill text-danger"></i>
                </div>
                <span class="fw-black fs-4">BloodLink</span>
            </a>
        </div>

        <div>
            <h1 class="display-4 fw-black">Join the National Network of Heroes.</h1>
            <p class="text-white-50">Register today to contribute to the blood supply chain and save lives.</p>
        </div>

        <small class="text-white-50 fw-bold">&copy; 2025 BloodLink</small>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 position-relative">
        <a href="/" class="back-home-btn">
            <i class="bi bi-arrow-left"></i>
            <span>Back to Home</span>
        </a>

        <div style="max-width: 420px; width:100%;">
            <h2 class="fw-black mb-2">Create Account</h2>
            <p class="text-secondary mb-4">Fill in the details to register your account</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4 position-relative">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" name="name" class="form-control form-control-custom"
                        placeholder="Full Name" required>
                </div>

                <div class="mb-4 position-relative">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control form-control-custom"
                        placeholder="Email Address" required>
                </div>

                <div class="mb-4 position-relative">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="phone" name="phone" class="form-control form-control-custom"
                        placeholder="Phone Number" required>
                </div>

                <div class="mb-4 position-relative">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="form-control form-control-custom"
                        placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-brand w-100 mb-3">
                    Register <i class="bi bi-arrow-right ms-2"></i>
                </button>

                <p class="text-center small">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-brand fw-bold">Sign in here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
