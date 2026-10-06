<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />
    <title>@yield('title', 'Tasty Food - Admin Panel')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    <style>
        .sidebar .nav > .nav-item a i {
            width: 25px;
        }
        .table-responsive {
            white-space: nowrap;
        }
    </style>

    @stack('styles')
    @yield('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('admin.dashboard') }}" class="logo text-decoration-none">
                        <span class="navbar-brand text-white fw-bold fs-4">
                            <span class="text-warning">Tasty</span> Food
                        </span>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Manajemen Konten</h4>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.foods.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.foods.index') }}">
                                <i class="fas fa-utensils"></i>
                                <p>Kelola Makanan</p>
                            </a>
                        </li>

                        @php
                            $unreadReviewsCount = \App\Models\Review::where('is_read', false)->count();
                        @endphp
                        <li class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.reviews.index') }}">
                                <i class="fas fa-comments"></i>
                                <p>Ulasan Pengunjung</p>
                                @if($unreadReviewsCount > 0)
                                    <span class="badge badge-warning">{{ $unreadReviewsCount }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Navigasi Luar</h4>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-globe"></i>
                                <p>Lihat Website</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="fas fa-sign-out-alt text-danger"></i>
                                <p class="text-danger">Logout</p>
                            </a>
                            <form id="sidebar-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('admin.dashboard') }}" class="logo text-decoration-none">
                            <span class="navbar-brand text-white fw-bold">
                                <span class="text-warning">Tasty</span> Food
                            </span>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-outline-secondary px-3 py-1 me-2" href="{{ route('home') }}" target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i> <span class="d-none d-sm-inline">Lihat Website</span>
                                </a>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="Admin Profile" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Admin</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="Profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>Administrator</h4>
                                                    <p class="text-muted">Tasty Food Admin</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                <i class="fas fa-home me-2"></i> Dashboard
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.foods.index') }}">
                                                <i class="fas fa-utensils me-2"></i> Kelola Makanan
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.reviews.index') }}">
                                                <i class="fas fa-comments me-2"></i> Ulasan Pengunjung
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('topbar-logout-form').submit();">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </a>
                                            <form id="topbar-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">@yield('page-title', 'Dashboard')</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            @yield('breadcrumbs')
                        </ul>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i> Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                    Tasty Food Website
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy; {{ date('Y') }} Tasty Food. Template Kaiadmin by <a href="http://www.themekita.com" target="_blank">ThemeKita</a>, Distributed by <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
