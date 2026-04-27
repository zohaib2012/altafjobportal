<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - National EduPortal Hub</title>
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
            --light-bg: #F1F5F9;
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary-navy) 0%, #1a2744 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: all var(--transition-smooth);
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--amber), var(--orange-gold));
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 15px rgba(59,130,246,0.4);
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            display: block;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-normal);
            position: relative;
            font-size: 0.925rem;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--amber);
            transform: scaleY(0);
            transition: transform var(--transition-normal);
            border-radius: 0 4px 4px 0;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.08);
            color: var(--white);
            padding-left: 1.75rem;
        }

        .nav-link:hover::before, .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: rgba(59,130,246,0.15);
            border-left: 3px solid var(--royal-blue);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        .nav-text {
            display: inline;
        }
        
        .nav-link.active i {
            color: var(--amber);
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: all var(--transition-smooth);
            min-height: 100vh;
        }

        .mobile-toggle {
            display: none;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-navy);
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--gray-light);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all var(--transition-smooth);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at top right, rgba(59,130,246,0.08) 0%, transparent 70%);
            transition: all var(--transition-smooth);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--royal-blue);
        }

        .stat-card:hover::after {
            width: 180px;
            height: 180px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(14,165,233,0.15));
            color: var(--royal-blue);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(252,211,77,0.15));
            color: var(--orange-gold);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(5,150,105,0.15));
            color: var(--green);
        }

        .stat-icon.red {
            background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(220,38,38,0.15));
            color: var(--red);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            color: var(--primary-navy);
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .data-table {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--gray-light);
            box-shadow: var(--shadow-sm);
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue));
            color: var(--white);
        }

        .data-table th {
            font-weight: 600;
            padding: 1rem 1.25rem;
            border: none;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .data-table td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-color: var(--gray-light);
            font-size: 0.9rem;
        }

        .data-table tbody tr {
            transition: all var(--transition-normal);
        }

        .data-table tbody tr:hover {
            background: rgba(59,130,246,0.04);
        }

        .data-table tbody tr:nth-child(even) {
            background: rgba(248,250,252,0.5);
        }

        .data-table tbody tr:nth-child(even):hover {
            background: rgba(59,130,246,0.04);
        }

        .badge-custom {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: capitalize;
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

        .action-btn {
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all var(--transition-normal);
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .search-box {
            background: var(--white);
            border: 2px solid var(--gray-light);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all var(--transition-normal);
            width: 300px;
            font-size: 0.9rem;
        }

        .search-box:focus {
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
            outline: none;
        }

        .filter-select {
            background: var(--white);
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.625rem 1rem;
            transition: all var(--transition-normal);
            font-size: 0.9rem;
        }

        .filter-select:focus {
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
            outline: none;
        }

        .form-control, .form-select {
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            padding: 0.625rem 1rem;
            transition: all var(--transition-normal);
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
            outline: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
            border: none;
            color: var(--white);
            font-weight: 600;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            transition: all var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(59,130,246,0.3);
            font-size: 0.9rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59,130,246,0.4);
            background: linear-gradient(135deg, var(--primary-blue), var(--royal-blue));
        }

        .btn-orange {
            background: linear-gradient(135deg, var(--orange-gold), #D97706);
            border: none;
            color: var(--dark);
            font-weight: 700;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            transition: all var(--transition-smooth);
        }

        .btn-orange:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, var(--amber), var(--orange-gold));
        }

        .pagination-wrap {
            margin-top: 1.5rem;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pagination .page-link {
            border: none;
            border-radius: 8px;
            margin: 0 3px;
            color: var(--dark);
            padding: 0.5rem 0.875rem;
            transition: all var(--transition-normal);
            font-size: 0.875rem;
        }

        .pagination .page-link:hover {
            background: var(--royal-blue);
            color: var(--white);
        }

        .pagination .page-item.active .page-link {
            background: var(--royal-blue);
            color: var(--white);
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (max-width: 1199px) {
            .stat-card {
                padding: 1.25rem;
            }
            .stat-number {
                font-size: 1.75rem;
            }
        }

@media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
                padding-bottom: 60px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-toggle {
                display: flex !important;
            }
            
            .sidebar-overlay {
                display: block;
                opacity: 0;
                pointer-events: none;
            }
            
            .sidebar-overlay.show {
                opacity: 1;
                pointer-events: auto;
            }
            
            .nav-link {
                padding: 0.75rem 1rem;
                justify-content: center;
                font-size: 0.85rem;
            }
            
            .nav-link i {
                width: 28px;
                font-size: 1.1rem;
                text-align: center;
                margin-right: 0;
            }
            
            .nav-link .badge {
                font-size: 0.55rem;
                padding: 0.1rem 0.35rem;
                position: absolute;
                top: 4px;
                right: 8px;
            }
            
            .sidebar .px-3 {
                display: none;
            }
            
            .sidebar .small {
                display: none;
            }
            
            .nav-text {
                display: none !important;
            }
            
            .sidebar .p-3 button {
                justify-content: center !important;
                padding: 0.75rem !important;
            }
            
            .sidebar .p-3 button span {
                display: none;
            }
            
            .sidebar .p-3 button i {
                margin: 0 !important;
                font-size: 1.2rem;
            }
            
            .sidebar-brand {
                justify-content: center;
                text-align: center;
            }
            
            .sidebar-brand > div:last-child {
                display: none;
            }
            
            .sidebar-brand-text {
                display: none;
            }
            
            .nav-text {
                display: none !important;
            }
            
            .sidebar .px-3 {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .search-box {
                width: 100%;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .data-table {
                overflow-x: auto;
            }
            
            .data-table table {
                min-width: 800px;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .page-header {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .stat-card {
                padding: 0.875rem;
            }
            
            .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 1.25rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
            
            .btn-primary-custom, .btn-orange {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <div class="sidebar-brand-icon" style="background:none;box-shadow:none;padding:0;overflow:hidden;">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width:48px;height:48px;object-fit:contain;" onerror="this.parentElement.innerHTML='<i class=\'fas fa-graduation-cap\' style=\'color:white;font-size:1.5rem;\'></i>'">
                    </div>
                    <div class="sidebar-brand-text">
                        <div class="fw-bold" style="font-size: 1.1rem;">Admin Panel</div>
                        <small style="opacity: 0.7; font-size: 0.75rem;">National EduPortal Hub</small>
                    </div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
<div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->is('admin') || request()->routeIs('admin.dashboard')) active @endif">
                        <i class="fas fa-tachometer-alt"></i><span class="nav-text"> Dashboard</span>
                    </a>
                </div>

                <div class="px-3 py-2 mt-1">
                    <small style="opacity: 0.4; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Applications</small>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.applications') }}" class="nav-link @if(request()->routeIs('admin.applications*')) active @endif">
                        <i class="fas fa-users"></i><span class="nav-text"> All Applications</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.applications') }}?status=pending" class="nav-link @if(request()->get('status') == 'pending') active @endif">
                        <i class="fas fa-clock"></i><span class="nav-text"> Pending</span>
                        <span class="ms-auto badge bg-warning text-dark" style="font-size: 0.65rem;">{{ \App\Models\Application::where('status','pending')->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.applications') }}?status=shortlisted" class="nav-link @if(request()->get('status') == 'shortlisted') active @endif">
                        <i class="fas fa-star"></i><span class="nav-text"> Shortlisted</span>
                        <span class="ms-auto badge bg-info" style="font-size: 0.65rem;">{{ \App\Models\Application::where('status','shortlisted')->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.applications') }}?status=approved" class="nav-link @if(request()->get('status') == 'approved') active @endif">
                        <i class="fas fa-check-circle"></i><span class="nav-text"> Approved</span>
                        <span class="ms-auto badge bg-success" style="font-size: 0.65rem;">{{ \App\Models\Application::where('status','approved')->count() }}</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.applications') }}?status=rejected" class="nav-link @if(request()->get('status') == 'rejected') active @endif">
                        <i class="fas fa-times-circle"></i><span class="nav-text"> Rejected</span>
                        <span class="ms-auto badge bg-danger" style="font-size: 0.65rem;">{{ \App\Models\Application::where('status','rejected')->count() }}</span>
                    </a>
                </div>

                <div class="px-3 py-2 mt-2">
                    <small style="opacity: 0.4; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Management</small>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.positions') }}" class="nav-link @if(request()->routeIs('admin.positions*')) active @endif">
                        <i class="fas fa-briefcase"></i><span class="nav-text"> Positions</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.merit-list') }}" class="nav-link @if(request()->routeIs('admin.merit-list')) active @endif">
                        <i class="fas fa-trophy"></i><span class="nav-text"> Merit List</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.export') }}" class="nav-link">
                        <i class="fas fa-file-csv"></i><span class="nav-text"> Export CSV</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link @if(request()->routeIs('admin.settings*')) active @endif">
                        <i class="fas fa-cog"></i><span class="nav-text"> Settings</span>
                    </a>
                </div>
            </nav>
            
            <div class="p-3" style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: auto;">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn w-100 d-flex align-items-center justify-content-center" style="background: rgba(255,255,255,0.1); color: var(--white); border-radius: 10px; padding: 0.75rem; font-weight: 500;">
                        <i class="fas fa-sign-out-alt" style="width: 20px;"></i><span class="nav-text" style="margin-left: 10px;">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="main-content">
            <div class="d-flex align-items-center mb-4">
                <button class="mobile-toggle btn me-3" onclick="toggleSidebar()" style="background: var(--primary-navy); color: white; padding: 0.625rem 0.875rem; border-radius: 10px; box-shadow: var(--shadow-md);">
                    <i class="fas fa-bars"></i>
                </button>
                @yield('header')
            </div>
            
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>