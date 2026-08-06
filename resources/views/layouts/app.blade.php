<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Penyerahan Hardcover') - Penyerahan Hardcover</title>
    <!-- Google Fonts & Bootstrap 5.3 & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-active: #6366f1;
            --bg-canvas: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-canvas);
            color: #334155;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            min-height: 100vh;
            transition: all 0.3s;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            color: #ffffff;
            font-weight: 800;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid #1e293b;
        }

        .sidebar-brand i {
            font-size: 1.5rem;
            color: #818cf8;
        }

        .nav-section-title {
            padding: 1rem 1.25rem 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            color: #f8fafc;
            background: var(--sidebar-hover);
        }

        .sidebar-link.active {
            color: #ffffff;
            background: var(--sidebar-hover);
            border-left-color: var(--sidebar-active);
            font-weight: 600;
        }

        .sidebar-link i {
            font-size: 1.1rem;
        }

        /* Main Content Styling */
        #content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .main-body {
            padding: 2rem;
            flex: 1;
        }

        /* Cards & Widgets */
        .card-custom {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-custom:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        }

        .stat-card {
            padding: 1.5rem;
            border-radius: 14px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Badges */
        .badge-skripsi {
            background-color: #ffedd5;
            color: #c2410c;
            border: 1px solid #fed7aa;
            font-weight: 600;
        }

        .badge-kkp {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
            font-weight: 600;
        }

        .badge-ta {
            background-color: #dbeafe;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            font-weight: 600;
        }

        .badge-sudah {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-belum {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Custom Buttons */
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            color: white;
        }

        .table-custom th {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.85rem 1rem;
        }

        .table-custom td {
            vertical-align: middle;
            padding: 0.85rem 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-book-half"></i>
            <span>Hardcover App</span>
        </div>
        <div class="py-3">
            <div class="nav-section-title">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('students.index') }}" class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Mahasiswa</span>
            </a>

            <div class="nav-section-title">Penyerahan Hardcover</div>
            <a href="{{ route('submissions.index') }}" class="sidebar-link {{ request()->routeIs('submissions.index') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Semua Penyerahan</span>
            </a>
            <a href="{{ route('submissions.byType', 'skripsi') }}" class="sidebar-link {{ request()->is('submissions/type/skripsi') ? 'active' : '' }}">
                <i class="bi bi-bookmark-star-fill text-warning"></i>
                <span>Skripsi (Orange)</span>
            </a>
            <a href="{{ route('submissions.byType', 'kkp') }}" class="sidebar-link {{ request()->is('submissions/type/kkp') ? 'active' : '' }}">
                <i class="bi bi-journal-check text-success"></i>
                <span>KKP</span>
            </a>
            <a href="{{ route('submissions.byType', 'ta') }}" class="sidebar-link {{ request()->is('submissions/type/ta') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark-fill text-primary"></i>
                <span>TA (Biru)</span>
            </a>

            <div class="nav-section-title">Informasi & Verifikasi</div>
            <a href="{{ route('requirements') }}" class="sidebar-link {{ request()->routeIs('requirements') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-check-fill text-info"></i>
                <span>Form Persyaratan TA/Skripsi</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div id="content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="mb-0 fw-bold text-slate-700">@yield('page_heading', 'Dashboard')</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-indigo-100 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background-color: #e0e7ff; color: #4338ca;">
                        <i class="bi bi-person-fill fw-bold"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-7 mb-0" style="font-size: 0.85rem;">{{ Auth::user()->name ?? 'Petugas Admin' }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email ?? 'admin@system.ac.id' }}</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Body -->
        <div class="main-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
