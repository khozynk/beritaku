<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #0ea5e9;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f4f8 100%);
            min-height: 100vh;
            color: var(--dark);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--darker) 0%, var(--dark) 100%);
            padding: 1.5rem;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            color: white;
            text-decoration: none;
        }

        .sidebar-brand i {
            font-size: 1.5rem;
        }

        .sidebar-brand span {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            color: var(--gray);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 1rem;
            margin-bottom: 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .header-title p {
            color: var(--gray);
            font-size: 0.875rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--light);
            border-radius: 50px;
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
            color: white;
        }

        .btn-secondary {
            background: var(--light);
            color: var(--dark);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .table th {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: var(--light);
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.02);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 50px;
        }

        .badge-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .badge-info {
            background: rgba(14, 165, 233, 0.1);
            color: #0284c7;
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.primary {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(14, 165, 233, 0.1) 100%);
            color: var(--primary);
        }

        .stat-icon.success {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .stat-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-icon.info {
            background: rgba(14, 165, 233, 0.1);
            color: var(--secondary);
        }

        .stat-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-info p {
            color: var(--gray);
            font-size: 0.875rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: var(--dark);
            background: white;
            border: 1px solid var(--border);
        }

        .pagination .active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Image Preview */
        .image-preview {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        /* Logout Form */
        .logout-form {
            width: 100%;
        }

        .logout-btn {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: #94a3b8;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-family: inherit;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <i class="fas fa-newspaper"></i>
            <span>Berita Admin</span>
        </a>

        <div class="nav-section">
            <div class="nav-section-title">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Manajemen Konten</div>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i>
                Kategori
            </a>
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                Berita
            </a>
            <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                Komentar
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Lainnya</div>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fas fa-globe"></i>
                Lihat Website
            </a>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <h1>@yield('title', 'Dashboard')</h1>
                <p>@yield('subtitle')</p>
            </div>
            <div class="header-actions">
                <div class="user-menu">
                    <div class="user-avatar">
                        <img src="{{ asset('images/admin-profile.jpg') }}" alt="{{ auth()->user()->name }}">
                    </div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
