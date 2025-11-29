<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard') | BeautyFly Aura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --purple-primary: #7a1fa2;
            --purple-dark: #4B0082;
            --purple-light: #b84ad9;
            --purple-lighter: #db7ee8;
            --purple-bg: #F3F4F6;
            --purple-gradient: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
            --purple-gradient-light: linear-gradient(135deg, #b84ad9 0%, #db7ee8 100%);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #F9FAFB;
            color: #1F2937;
        }

        /* Sidebar Navigation */
        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: var(--purple-gradient);
            box-shadow: 2px 0 10px rgba(122, 31, 162, 0.2);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .admin-sidebar .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar .sidebar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-sidebar .sidebar-brand i {
            font-size: 1.75rem;
        }

        .admin-sidebar .nav-menu {
            padding: 1rem 0;
        }

        .admin-sidebar .nav-item {
            margin: 0.25rem 0.75rem;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .admin-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        .admin-sidebar .nav-link i {
            font-size: 1.1rem;
            width: 20px;
        }

        /* Main Content Area */
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .admin-header {
            background: white;
            padding: 1.25rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--purple-dark);
            margin: 0;
        }

        .admin-header .header-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .admin-content {
            padding: 2rem;
        }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #E5E7EB;
            overflow: hidden;
        }

        .admin-card .card-header {
            background: var(--purple-gradient);
            color: white;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            border: none;
        }

        .admin-card .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-purple {
            background: var(--purple-gradient);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-purple:hover {
            background: var(--purple-gradient-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(122, 31, 162, 0.4);
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--purple-primary);
            color: var(--purple-primary);
            background: transparent;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-outline-purple:hover {
            background: var(--purple-primary);
            color: white;
            transform: translateY(-1px);
        }

        /* Tables */
        .admin-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .admin-table table {
            margin: 0;
        }

        .admin-table thead {
            background: var(--purple-gradient);
            color: white;
        }

        .admin-table thead th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-table tbody tr {
            transition: all 0.2s ease;
        }

        .admin-table tbody tr:hover {
            background: #F9FAFB;
            transform: scale(1.01);
        }

        .admin-table tbody td {
            padding: 1rem;
            border-color: #E5E7EB;
            vertical-align: middle;
        }

        /* Badges */
        .badge-purple {
            background: var(--purple-gradient);
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.25rem;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #D1D5DB;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--purple-primary);
            box-shadow: 0 0 0 3px rgba(122, 31, 162, 0.15);
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--purple-primary);
            border-color: #E5E7EB;
        }

        .pagination .page-item.active .page-link {
            background: var(--purple-gradient);
            border-color: var(--purple-primary);
        }

        .pagination .page-link:hover {
            background: var(--purple-light);
            color: white;
            border-color: var(--purple-primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-content {
                padding: 1rem;
            }
        }

        /* User Info in Sidebar */
        .sidebar-user {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .sidebar-user .user-info {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        .sidebar-user .btn-logout {
            width: 100%;
            margin-top: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .sidebar-user .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar d-flex flex-column">
        <div class="sidebar-header">
            <a href="{{ route('admin.products.index') }}" class="sidebar-brand">
                <i class="bi bi-shield-check"></i>
                <span>Admin Panel</span>
            </a>
        </div>
        
        <nav class="nav-menu flex-grow-1">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-cart-check"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
                        <i class="bi bi-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                        <i class="bi bi-envelope"></i>
                        <span>Contacts</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-user">
            <div class="user-info">
                @auth
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                @endauth
            </div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light w-100 mb-2">
                <i class="bi bi-house"></i> Frontend
            </a>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout w-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-header">
            <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            <div class="header-actions">
                <button class="btn btn-outline-purple d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.querySelector('[data-bs-target="#mobileMenu"]')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>
