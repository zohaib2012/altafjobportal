<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'National EduPortal Hub') - Job Application Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #0F172A;
            --primary-blue: #1E40AF;
            --royal-blue: #3B82F6;
            --sky-blue: #0EA5E9;
            --orange-gold: #F59E0B;
            --amber: #FCD34D;
            --green: #10B981;
            --red: #EF4444;
            --light-bg: #F8FAFC;
            --white: #FFFFFF;
            --dark: #1E293B;
            --gray: #64748B;
            --gray-light: #E2E8F0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 15px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.15);
            --shadow-glow: 0 0 30px rgba(59,130,246,0.3);
            --transition-fast: 150ms ease;
            --transition-normal: 250ms ease;
            --transition-smooth: 350ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --light-bg: #0F172A;
            --white: #1E293B;
            --dark: #F8FAFC;
            --gray: #94A3B8;
            --gray-light: #334155;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            transition: background var(--transition-smooth), color var(--transition-smooth);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        a {
            text-decoration: none;
            transition: all var(--transition-normal);
        }

        .navbar-custom {
            background: var(--primary-navy);
            box-shadow: var(--shadow-md);
            padding: 0.75rem 0;
            transition: all var(--transition-smooth);
        }

        .navbar-custom.scrolled {
            padding: 0.5rem 0;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .navbar-brand .brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .navbar-brand .brand-text {
            line-height: 1.2;
        }

        .navbar-brand .brand-title {
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand .brand-tagline {
            color: var(--amber);
            font-size: 0.65rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            position: relative;
            transition: all var(--transition-normal);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--amber);
            transition: all var(--transition-normal);
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: var(--white) !important;
            background: rgba(255,255,255,0.1);
        }

        .nav-link:hover::after {
            width: 60%;
        }

        .nav-link.active::after {
            width: 60%;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
            border: none;
            color: var(--white);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            transition: all var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(59,130,246,0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59,130,246,0.4);
            background: linear-gradient(135deg, var(--sky-blue), var(--royal-blue));
        }

        .btn-orange {
            background: linear-gradient(135deg, var(--orange-gold), #D97706);
            border: none;
            color: var(--dark);
            font-weight: 700;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            transition: all var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(245,158,11,0.35);
        }

        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245,158,11,0.45);
            background: linear-gradient(135deg, var(--amber), var(--orange-gold));
            color: var(--dark);
        }

        .btn-outline-light {
            border: 2px solid rgba(255,255,255,0.4);
            color: var(--white);
            font-weight: 600;
            padding: 0.55rem 1.25rem;
            border-radius: 10px;
            transition: all var(--transition-smooth);
            background: transparent;
        }

        .btn-outline-light:hover {
            background: var(--white);
            color: var(--primary-navy);
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-navy) 0%, #1E3A8A 50%, var(--primary-blue) 100%);
            color: var(--white);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,0.3) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245,158,11,0.2) 0%, transparent 70%);
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }

        .card-custom {
            background: var(--white);
            border: 1px solid var(--gray-light);
            border-radius: 16px;
            transition: all var(--transition-smooth);
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--royal-blue);
        }

        .feature-card {
            background: var(--white);
            border: 1px solid var(--gray-light);
            border-radius: 16px;
            padding: 2rem;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--royal-blue), var(--sky-blue));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--transition-smooth);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 1rem;
            transition: all var(--transition-smooth);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: var(--shadow-glow);
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: radial-gradient(circle at top right, rgba(59,130,246,0.1) 0%, transparent 70%);
            transition: all var(--transition-smooth);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card:hover::after {
            width: 120px;
            height: 120px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-navy), var(--royal-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-control, .form-select {
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all var(--transition-normal);
            background: var(--white);
            color: var(--dark);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .badge-custom {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-pending {
            background: rgba(245,158,11,0.15);
            color: #D97706;
        }

        .badge-approved {
            background: rgba(16,185,129,0.15);
            color: #059669;
        }

        .badge-rejected {
            background: rgba(239,68,68,0.15);
            color: #DC2626;
        }

        footer {
            background: var(--primary-navy);
            color: rgba(255,255,255,0.92);
            padding: 4rem 0 2rem;
            margin-top: auto;
        }

        footer h6 {
            color: var(--white);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        footer a {
            color: rgba(255,255,255,0.92);
            transition: all var(--transition-normal);
        }

        footer a:hover {
            color: var(--amber);
            padding-left: 5px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .footer-brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--white);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.1);
            color: var(--white);
            cursor: pointer;
            transition: all var(--transition-normal);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background: rgba(255,255,255,0.2);
            transform: rotate(15deg);
        }

        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-navy);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255,255,255,0.2);
            border-top-color: var(--amber);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .table-custom {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--gray-light);
        }

        .table-custom table {
            margin-bottom: 0;
        }

        .table-custom thead {
            background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue));
            color: var(--white);
        }

        .table-custom th {
            font-weight: 600;
            padding: 1rem;
            border: none;
        }

        .table-custom td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--gray-light);
        }

        .table-custom tbody tr {
            transition: all var(--transition-normal);
        }

        .table-custom tbody tr:hover {
            background: rgba(59,130,246,0.05);
        }

        .pagination-custom .page-link {
            border: none;
            border-radius: 8px;
            margin: 0 3px;
            color: var(--dark);
            padding: 0.5rem 0.9rem;
            transition: all var(--transition-normal);
        }

        .pagination-custom .page-link:hover {
            background: var(--royal-blue);
            color: var(--white);
        }

        .pagination-custom .page-item.active .page-link {
            background: var(--royal-blue);
            color: var(--white);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: #0f2044;
                padding: 1rem;
                border-radius: 12px;
                margin-top: 0.5rem;
                border: 1px solid rgba(255,255,255,0.15);
            }

            .navbar-collapse .nav-link {
                color: #ffffff !important;
                font-weight: 600;
                padding: 0.65rem 1rem !important;
                border-bottom: 1px solid rgba(255,255,255,0.08);
            }

            .navbar-collapse .nav-link:last-child {
                border-bottom: none;
            }

            .navbar-collapse .d-flex {
                margin-top: 0.75rem;
                flex-wrap: wrap;
                gap: 0.5rem !important;
            }

            .navbar-toggler-icon {
                filter: brightness(0) invert(1);
            }

            .hero-section {
                padding: 80px 0 60px;
            }

            .hero-section h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 767px) {
            .stat-number {
                font-size: 2rem;
            }

            .feature-card, .stat-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .btn-orange, .btn-primary-custom {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .hero-section {
                padding: 60px 0 40px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="brand-icon">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="National EduPortal Hub Logo" onerror="this.parentElement.innerHTML='<i class=\'fas fa-graduation-cap\' style=\'color:white;font-size:1.5rem;\'></i>'">
                </div>
                <div class="brand-text">
                    <div class="brand-title">National EduPortal Hub</div>
                    <div class="brand-tagline">Learn · Connect · Succeed</div>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="background: rgba(255,255,255,0.1); padding: 0.5rem; border-radius: 8px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('/')) active @endif" href="/">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('apply')) active @endif" href="{{ route('apply') }}">
                            <i class="fas fa-user-plus me-1"></i> Apply Online
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('instructions')) active @endif" href="{{ route('instructions') }}">
                            <i class="fas fa-info-circle me-1"></i> Instructions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('contact')) active @endif" href="{{ route('contact') }}">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Theme">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </button>
                    <a href="{{ route('apply') }}" class="btn btn-orange">
                        <i class="fas fa-paper-plane me-1"></i> Apply
                    </a>
                    @auth
                        <a href="{{ route('upload.dashboard') }}" class="btn btn-outline-light">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn" style="background:rgba(239,68,68,0.15);border:1.5px solid rgba(239,68,68,0.5);color:#fca5a5;border-radius:10px;padding:0.5rem 1rem;font-weight:600;">
                                <i class="fas fa-sign-out-alt me-1"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-brand-icon" style="background:none;box-shadow:none;padding:0;">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="National EduPortal Hub Logo" style="width:48px;height:48px;object-fit:contain;" onerror="this.parentElement.innerHTML='<i class=\'fas fa-graduation-cap\' style=\'color:white;font-size:1.5rem;\'></i>'">
                        </div>
                        <div>
                            <div class="text-white fw-bold" style="font-family: 'Poppins', sans-serif;">National EduPortal Hub</div>
                            <small>Learn · Connect · Succeed</small>
                        </div>
                    </div>
                    <p class="small" style="color: rgba(255,255,255,0.92);">Empowering Pakistan through quality education and career opportunities. Join thousands of candidates building their future.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm" style="background: rgba(255,255,255,0.1); border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-sm" style="background: rgba(255,255,255,0.1); border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-sm" style="background: rgba(255,255,255,0.1); border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-sm" style="background: rgba(255,255,255,0.1); border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('apply') }}">Apply Online</a></li>
                        <li><a href="{{ route('instructions') }}">Instructions</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6>Positions</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('apply') }}">Teaching Staff</a></li>
                        <li><a href="{{ route('apply') }}">Non-Teaching</a></li>
                        <li><a href="{{ route('apply') }}">Administrative</a></li>
                        <li><a href="{{ route('apply') }}">Support Staff</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6>Contact Info</h6>
                    <ul class="list-unstyled d-flex flex-column gap-3">
                        <li class="d-flex align-items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1" style="color: var(--amber);"></i>
                            <small>Block-5, Clifton Commercial Area, Karachi, Pakistan</small>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fas fa-phone" style="color: var(--amber);"></i>
                            <small>+92 21 3456 7890</small>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="fas fa-envelope" style="color: var(--amber);"></i>
                            <small>info@nationaleduportalhub.pk</small>
                        </li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0;">
            <div class="text-center">
                <small style="color: rgba(255,255,255,0.85);">&copy; {{ date('Y') }} National EduPortal Hub. All rights reserved.</small>
            </div>
        </div>
    </footer>

    {{-- WhatsApp Floating Button --}}
    <a href="https://wa.me/923393511003" target="_blank" rel="noopener noreferrer"
       title="Chat on WhatsApp"
       style="position:fixed;bottom:24px;right:24px;z-index:9999;width:58px;height:58px;background:#25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(37,211,102,0.5);text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;"
       onmouseover="this.style.transform='scale(1.12)';this.style.boxShadow='0 8px 28px rgba(37,211,102,0.65)'"
       onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 4px 20px rgba(37,211,102,0.5)'">
        <i class="fab fa-whatsapp" style="color:#fff;font-size:2rem;line-height:1;"></i>
    </a>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }

        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.getElementById('themeIcon').classList.remove('fa-moon');
            document.getElementById('themeIcon').classList.add('fa-sun');
        }

        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>