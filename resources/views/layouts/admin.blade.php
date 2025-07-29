<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard - @yield('title')</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .sidebar .nav-item .nav-link {
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }

        .sidebar .nav-item .nav-link:active {
            transform: translateY(2px);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Styling untuk breadcrumb di navbar kiri */
        .navbar-breadcrumb {
            padding: 0.75rem 1rem;
            margin-left: 0.5rem;
            background-color: transparent;
            margin-top: 0.5rem;
            /* Jarak atas tetap ada */
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item {
            font-size: 0.8rem;
            /* Dikurangi dari 0.9rem menjadi 0.8rem */
        }

        .breadcrumb-item a {
            color: #858796;
        }

        .breadcrumb-item.active {
            color: #4e73df;
            font-weight: 600;
        }

        .page-title {
            font-size: 1.5rem;
            /* Dikurangi dari 1.75rem menjadi 1.5rem */
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SmartGrade</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ Request::routeIs('admin.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item {{ Request::routeIs('admin.user.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item {{ Request::routeIs('admin.guru.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.guru.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Guru</span>
                </a>
            </li>
            <li class="nav-item {{ Request::routeIs('admin.murid.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.murid.index') }}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Murid</span>
                </a>
            </li>
            <li class="nav-item {{ Request::routeIs('admin.mapel.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.mapel.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item {{ Request::routeIs('admin.nilai.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.nilai.index') }}">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Nilai</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Addons
            </div>

            <li class="nav-item {{ Request::routeIs('admin.about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.about') }}">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>About Us</span>
                </a>
            </li>
            <li class="nav-item {{ Request::routeIs('admin.faq') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.faq') }}">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>FAQ</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="navbar-breadcrumb">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb')</li>
                            </ol>
                        </nav>
                        <!-- Page Title -->
                        <h1 class="page-title">@yield('page-title')</h1>
                    </div>

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->username }}
                                </span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admin.profil') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}" rel="stylesheet">
        < script src = "{{ asset('js/demo/datatables-demo.js') }}" >
    </script>
        ...
    @stack('scripts')

</body>

</html>
