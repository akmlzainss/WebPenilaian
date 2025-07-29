<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Guru Dashboard - @yield('title')</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light-color);
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
            font-size: 1.75rem;
            transform: rotate(-15deg);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .navbar-nav .nav-link i {
            margin-right: 0.5rem;
            width: 1.25rem;
        }

        /* User Dropdown */
        .user-dropdown {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            padding: 0.25rem 0.75rem;
        }

        .user-dropdown .dropdown-toggle {
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .user-dropdown .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            margin-left: 0.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.25rem;
            font-weight: 500;
        }

        .dropdown-item i {
            width: 1.25rem;
            margin-right: 0.5rem;
            color: var(--secondary-color);
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
        }

        .dropdown-divider {
            margin: 0.5rem 0;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--secondary-color);
            font-size: 1.1rem;
            margin: 0;
        }

        /* Cards */
        .card-custom {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(33, 40, 50, 0.2);
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            border: none;
            padding: 1.25rem;
            font-weight: 600;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        /* Statistics Cards */
        .stat-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(33, 40, 50, 0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }

        .stat-label {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-icon {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 2rem;
            color: rgba(78, 115, 223, 0.2);
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.3);
            color: white;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Timeline */
        .timeline-item .timeline-marker {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Table */
        .table-borderless td, .table-borderless th {
            border: none;
        }

        /* Footer */
        .footer-custom {
            background: white;
            margin-top: 3rem;
            padding: 1.5rem 0;
            border-top: 1px solid #e3e6f0;
            color: var(--secondary-color);
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-nav {
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                margin-top: 1rem;
                padding: 0.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-icon {
                font-size: 1.5rem;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .col-lg-8, .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: rgba(28, 200, 138, 0.1);
            color: #0f5132;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background-color: rgba(231, 74, 59, 0.1);
            color: #842029;
            border-left: 4px solid var(--danger-color);
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(78, 115, 223, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guru.dashboard') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                Guru Panel
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox=\'0 0 30 30\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke=\'rgba(255,255,255,0.8)\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/%3E%3C/svg%3E');"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('guru.dashboard') ? 'active' : '' }}" href="{{ route('guru.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('guru.nilai.*') ? 'active' : '' }}" href="{{ route('guru.nilai.index') }}">
                            <i class="fas fa-clipboard-list"></i> Nilai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('guru.murid.*') ? 'active' : '' }}" href="{{ route('guru.murid.search') }}">
                            <i class="fas fa-search"></i> Cari Murid
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('guru.about') ? 'active' : '' }}" href="{{ route('guru.about') }}">
                            <i class="fas fa-info-circle"></i> About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('guru.faq') ? 'active' : '' }}" href="{{ route('guru.faq') }}">
                            <i class="fas fa-question-circle"></i> FAQ
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-lg-inline">{{ auth()->user()->guru->nama }}</span>
                            <img class="user-avatar" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=ffffff&color=4e73df&bold=true" alt="User Avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('guru.profil') }}">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <p class="page-subtitle">@yield('page-subtitle', 'Selamat datang di panel guru')</p>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span>© 2025 Guru Dashboard. All rights reserved.</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span>Made with <i class="fas fa-heart text-danger"></i> for education</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        // Add smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Add loading state to buttons
        $(document).on('click', '.btn', function() {
            if (!$(this).hasClass('btn-close') && !$(this).hasClass('dropdown-toggle')) {
                $(this).html('<span class="loading"></span> Loading...');
                setTimeout(() => $(this).html($(this).data('original-text') || $(this).text().replace('<span class="loading"></span> Loading...', '')), 2000);
                $(this).data('original-text', $(this).html());
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
```