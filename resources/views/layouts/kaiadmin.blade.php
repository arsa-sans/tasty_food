<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', 'Admin Dashboard') - Tasty Food</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Boxicons (matching live site icons) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
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
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    @php
                        $unreadMessagesCount = \App\Models\Message::where('status', 'belum_dibaca')->count();
                        $unconfirmedOrdersCount = \App\Models\Order::where('status', 'menunggu_konfirmasi')->count();
                    @endphp
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Restoran & Penjualan Section -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Pemesanan & Menu</h4>
                        </li>

                        <!-- Pesanan Pelanggan -->
                        <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#ordersMenu" class="{{ request()->routeIs('admin.orders.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-shopping-bag"></i>
                                <p>Pesanan</p>
                                @if($unconfirmedOrdersCount > 0)
                                    <span class="badge badge-danger me-2">{{ $unconfirmedOrdersCount }}</span>
                                @endif
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.orders.*') ? 'show' : '' }}" id="ordersMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.orders.index') && request()->query('status') !== 'menunggu_konfirmasi' ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.index') }}">
                                            <span class="sub-item">Semua Pesanan</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.orders.index') && request()->query('status') === 'menunggu_konfirmasi' ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.index', ['status' => 'menunggu_konfirmasi']) }}">
                                            <span class="sub-item">Menunggu Konfirmasi</span>
                                            @if($unconfirmedOrdersCount > 0)
                                                <span class="badge badge-danger float-end">{{ $unconfirmedOrdersCount }}</span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Menu Makanan CRUD -->
                        <li class="nav-item {{ request()->routeIs('admin.menu.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#menuFoodMenu" class="{{ request()->routeIs('admin.menu.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-utensils"></i>
                                <p>Menu Makanan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.menu.*') ? 'show' : '' }}" id="menuFoodMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.menu.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.menu.index') }}">
                                            <span class="sub-item">Daftar Menu</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.menu.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.menu.create') }}">
                                            <span class="sub-item">Tambah Menu</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Metode Pembayaran CRUD -->
                        <li class="nav-item {{ request()->routeIs('admin.payment-methods.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#paymentMethodsMenu" class="{{ request()->routeIs('admin.payment-methods.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-credit-card"></i>
                                <p>Metode Pembayaran</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.payment-methods.*') ? 'show' : '' }}" id="paymentMethodsMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.payment-methods.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.payment-methods.index') }}">
                                            <span class="sub-item">Daftar Metode</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.payment-methods.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.payment-methods.create') }}">
                                            <span class="sub-item">Tambah Metode</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Website Management Section -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Konten Website</h4>
                        </li>

                        <!-- Berita -->
                        <li class="nav-item {{ request()->routeIs('admin.berita.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#beritaMenu" class="{{ request()->routeIs('admin.berita.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.berita.*') ? 'show' : '' }}" id="beritaMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.berita.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.berita.index') }}">
                                            <span class="sub-item">All Berita</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.berita.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.berita.create') }}">
                                            <span class="sub-item">Add Berita</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Gallery -->
                        <li class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#galeriMenu" class="{{ request()->routeIs('admin.galeri.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-images"></i>
                                <p>Gallery</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.galeri.*') ? 'show' : '' }}" id="galeriMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.galeri.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.galeri.index') }}">
                                            <span class="sub-item">All Gallery</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.galeri.create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.galeri.create') }}">
                                            <span class="sub-item">Add Gallery</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Messages -->
                        <li class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active submenu' : '' }}">
                            <a data-bs-toggle="collapse" href="#messagesMenu" class="{{ request()->routeIs('admin.messages.*') ? '' : 'collapsed' }}">
                                <i class="fas fa-envelope"></i>
                                <p>Messages</p>
                                @if($unreadMessagesCount > 0)
                                    <span class="badge badge-warning me-2">{{ $unreadMessagesCount }}</span>
                                @endif
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('admin.messages.*') ? 'show' : '' }}" id="messagesMenu">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('admin.messages.index') && request()->query('status') !== 'belum_dibaca' ? 'active' : '' }}">
                                        <a href="{{ route('admin.messages.index') }}">
                                            <span class="sub-item">All Messages</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('admin.messages.index') && request()->query('status') === 'belum_dibaca' ? 'active' : '' }}">
                                        <a href="{{ route('admin.messages.index', ['status' => 'belum_dibaca']) }}">
                                            <span class="sub-item">Unread Messages</span>
                                            @if($unreadMessagesCount > 0)
                                                <span class="badge badge-danger float-end">{{ $unreadMessagesCount }}</span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Open Public Pages Section -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Open Public Pages</h4>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tentang') }}" target="_blank">
                                <i class="fas fa-info-circle"></i>
                                <p>Tentang</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('berita') }}" target="_blank">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('galeri') }}" target="_blank">
                                <i class="fas fa-images"></i>
                                <p>Galeri</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kontak') }}" target="_blank">
                                <i class="fas fa-phone"></i>
                                <p>Kontak</p>
                                <span class="badge badge-secondary"><i class="fas fa-external-link-alt fa-xs"></i></span>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item mt-3">
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
                        <nav class="navbar navbar-line navbar-header-left navbar-expand-lg p-0 d-none d-lg-flex">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h4>
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <!-- Messages Notification Icon -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="{{ route('admin.messages.index', ['status' => 'belum_dibaca']) }}" title="Pesan Belum Dibaca">
                                    <i class="fa fa-envelope"></i>
                                    @if($unreadMessagesCount > 0)
                                        <span class="notification">{{ $unreadMessagesCount }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hai,</span>
                                        <span class="fw-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name ?? 'Admin' }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email ?? 'admin@tastyfood.com' }}</p>
                                                    <a href="{{ route('home') }}" target="_blank" class="btn btn-xs btn-secondary btn-sm">Lihat Website</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('admin.berita.index') }}">Kelola Berita</a>
                                            <a class="dropdown-item" href="{{ route('admin.galeri.index') }}">Kelola Gallery</a>
                                            <a class="dropdown-item" href="{{ route('admin.messages.index') }}">Kelola Messages</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                                </button>
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
                    <!-- Page Header / Breadcrumbs -->
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">@yield('page-title', 'Dashboard')</h3>
                            <h6 class="op-7 mb-2">@yield('page-subtitle', 'Sistem Administrasi Tasty Food')</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            @yield('breadcrumbs')
                        </div>
                    </div>

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Perhatian:</strong> Terdapat kesalahan input.
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Main Content -->
                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}" target="_blank">Tasty Food</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy; {{ date('Y') }}, dibuat dengan <i class="fa fa-heart heart text-danger"></i> untuk Tasty Food
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
</body>
</html>
