<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Portal berita terkini dan terpercaya')">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #0ea5e9;
            --accent: #f43f5e;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 0.5rem;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
        }

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

        .btn-outline {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
        }

        /* Search Box */
        .search-box {
            position: relative;
        }

        .search-input {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            color: white;
            font-size: 0.875rem;
            width: 200px;
            transition: all 0.3s;
        }

        .search-input::placeholder {
            color: #94a3b8;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255,255,255,0.15);
            width: 250px;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .featured-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 400px;
        }

        .featured-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
        }

        .featured-category {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 0.375rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .featured-title {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .featured-meta {
            color: #94a3b8;
            font-size: 0.875rem;
            display: flex;
            gap: 1rem;
        }

        .sidebar-news {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .sidebar-card {
            display: flex;
            gap: 1rem;
            background: rgba(255,255,255,0.05);
            padding: 1rem;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .sidebar-card:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .sidebar-card img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .sidebar-card-content h4 {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .sidebar-card-content span {
            color: #64748b;
            font-size: 0.75rem;
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0 4rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 28px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 4px;
        }

        .view-all {
            color: var(--primary);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-all:hover {
            gap: 0.75rem;
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .news-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .news-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .news-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .news-card:hover .news-card-image img {
            transform: scale(1.1);
        }

        .news-card-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .news-card-body {
            padding: 1.5rem;
        }

        .news-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            color: var(--dark);
        }

        .news-card-excerpt {
            color: var(--gray);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .news-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--gray);
            font-size: 0.8rem;
        }

        .news-card-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Categories */
        .categories {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .category-pill {
            padding: 0.5rem 1rem;
            background: white;
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray);
            transition: all 0.3s;
        }

        .category-pill:hover,
        .category-pill.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Footer */
        .footer {
            background: var(--darker);
            color: #94a3b8;
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand {
            margin-bottom: 1.5rem;
        }

        .footer-brand .logo {
            margin-bottom: 1rem;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .footer-title {
            color: white;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: #94a3b8;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            font-size: 0.875rem;
        }

        /* Alert */
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

        /* Responsive - Desktop (default) */
        
        /* Tablet Landscape (1024px) */
        @media (max-width: 1024px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            .hero-content {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .sidebar-news {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        /* Tablet Portrait (768px) */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .search-box {
                display: none;
            }
            .nav {
                gap: 1rem;
            }
            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            .featured-card {
                height: 280px;
            }
            .featured-title {
                font-size: 1.25rem;
            }
            .featured-overlay {
                padding: 1.5rem;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .section-title {
                font-size: 1.25rem;
            }
            .hero {
                padding: 2rem 0;
                margin-bottom: 2rem;
            }
            .sidebar-news {
                grid-template-columns: 1fr;
            }
            .categories {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 0.5rem;
                -webkit-overflow-scrolling: touch;
            }
            .category-pill {
                white-space: nowrap;
                flex-shrink: 0;
            }
            .btn {
                padding: 0.625rem 1rem;
                font-size: 0.8rem;
            }
            .main-content {
                padding: 1.5rem 0 3rem;
            }
            .container {
                padding: 0 0.75rem;
            }
        }

        /* Mobile Large - Android/iPhone Plus (480px) */
        @media (max-width: 480px) {
            .header {
                padding: 0.75rem 0;
            }
            .logo-icon {
                width: 38px;
                height: 38px;
                font-size: 1rem;
                border-radius: 10px;
            }
            .logo-text {
                font-size: 1.25rem;
            }
            .featured-card {
                height: 220px;
                border-radius: 16px;
            }
            .featured-title {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            .featured-category {
                padding: 0.25rem 0.75rem;
                font-size: 0.65rem;
                margin-bottom: 0.5rem;
            }
            .featured-meta {
                font-size: 0.75rem;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            .featured-overlay {
                padding: 1rem;
            }
            .news-card {
                border-radius: 12px;
            }
            .news-card-image {
                height: 160px;
            }
            .news-card-body {
                padding: 1rem;
            }
            .news-card-title {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            .news-card-excerpt {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .news-card-meta {
                font-size: 0.7rem;
            }
            .author-avatar {
                width: 24px;
                height: 24px;
                font-size: 0.6rem;
            }
            .section-title {
                font-size: 1.1rem;
            }
            .section-title::before {
                width: 3px;
                height: 22px;
            }
            .view-all {
                font-size: 0.85rem;
            }
            .footer {
                padding: 2.5rem 0 1.5rem;
            }
            .footer-title {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            .footer-brand p {
                font-size: 0.8rem;
            }
            .footer-links a {
                font-size: 0.8rem;
            }
            .footer-bottom {
                font-size: 0.75rem;
                padding-top: 1.5rem;
            }
            .alert {
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
            }
            .sidebar-card {
                padding: 0.75rem;
            }
            .sidebar-card img {
                width: 70px;
                height: 50px;
            }
            .sidebar-card-content h4 {
                font-size: 0.8rem;
            }
            .btn-primary, .btn-outline {
                padding: 0.5rem 0.875rem;
                font-size: 0.75rem;
            }
        }

        /* Mobile Small - iPhone SE, small Android (375px) */
        @media (max-width: 375px) {
            .logo-text {
                font-size: 1.1rem;
            }
            .logo-icon {
                width: 34px;
                height: 34px;
                font-size: 0.9rem;
            }
            .featured-card {
                height: 200px;
            }
            .featured-title {
                font-size: 0.95rem;
            }
            .news-card-image {
                height: 140px;
            }
            .news-card-title {
                font-size: 0.95rem;
            }
            .container {
                padding: 0 0.5rem;
            }
        }

        /* Touch device optimizations */
        @media (hover: none) and (pointer: coarse) {
            .news-card:hover {
                transform: none;
            }
            .news-card:active {
                transform: scale(0.98);
            }
            .sidebar-card:hover {
                transform: none;
            }
            .sidebar-card:active {
                background: rgba(255,255,255,0.15);
            }
            .category-pill:hover {
                background: white;
                border-color: var(--border);
                color: var(--gray);
            }
            .category-pill:active,
            .category-pill.active {
                background: var(--primary);
                border-color: var(--primary);
                color: white;
            }
            .btn:hover {
                transform: none;
            }
            .btn:active {
                transform: scale(0.95);
            }
        }

        /* Landscape mode for mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero {
                padding: 1.5rem 0;
                margin-bottom: 1.5rem;
            }
            .featured-card {
                height: 200px;
            }
            .main-content {
                padding: 1rem 0 2rem;
            }
        }

        /* High DPI screens (Retina) */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .news-card-image img,
            .featured-card img,
            .sidebar-card img {
                image-rendering: -webkit-optimize-contrast;
            }
        }

        /* Safe area for iPhone X and newer (notch) */
        @supports (padding-top: env(safe-area-inset-top)) {
            .header {
                padding-top: max(1rem, env(safe-area-inset-top));
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);
            }
            .footer {
                padding-bottom: max(2rem, env(safe-area-inset-bottom));
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);
            }
        }

        /* Print styles */
        @media print {
            .header, .footer, .search-box, .nav-actions, .categories {
                display: none !important;
            }
            .news-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <span class="logo-text">BeritaKu</span>
                </a>

                <nav class="nav">
                    <div class="nav-links">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                        <a href="{{ route('news.index') }}" class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}">Berita</a>
                    </div>

                    <form action="{{ route('news.index') }}" method="GET" class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="cari" class="search-input" placeholder="Cari berita..." value="{{ request('cari') }}">
                    </form>

                    <div class="nav-actions">
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </header>

    @yield('hero')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="logo">
                        <div class="logo-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <span class="logo-text">BeritaKu</span>
                    </a>
                    <p>Portal berita terkini dan terpercaya. Menyajikan informasi akurat dan berimbang untuk pembaca Indonesia.</p>
                </div>

                <div>
                    <h4 class="footer-title">Kategori</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('news.index', ['kategori' => 'politik']) }}">Politik</a></li>
                        <li><a href="{{ route('news.index', ['kategori' => 'ekonomi']) }}">Ekonomi</a></li>
                        <li><a href="{{ route('news.index', ['kategori' => 'olahraga']) }}">Olahraga</a></li>
                        <li><a href="{{ route('news.index', ['kategori' => 'teknologi']) }}">Teknologi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Tautan</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('news.index') }}">Semua Berita</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Ikuti Kami</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} BeritaKu. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
