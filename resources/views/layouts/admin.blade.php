<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - Servis Motor')</title>
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>

    <div class="admin-layout-wrapper">
        <!-- Left Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-top">
                <a href="{{ route('home') }}" class="admin-sidebar-logo" style="display:flex; align-items:center; gap:16px; margin-bottom:40px; text-decoration:none;">
                    <img src="{{ asset('assets/logo.png') }}" alt="Turbo Garage" style="width: 55px; height: 55px; object-fit: contain; flex-shrink: 0;">
                    <div style="display:flex; flex-direction:column; text-align:left; font-family:'Outfit', sans-serif; font-size:1.45rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em;">
                        <span style="color:#ffffff; text-transform:none;">Turbo</span>
                        <span style="color:#c4a51e; text-transform:none;">Garage</span>
                    </div>
                </a>
                
                <ul class="admin-sidebar-menu">
                    <li>
                        <a href="#" class="admin-sidebar-link active" data-tab="dashboard">
                            <i data-lucide="home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="cabang">
                            <i data-lucide="share-2"></i> Cabang
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="booking">
                            <i data-lucide="clipboard-list"></i> Booking
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="servis">
                            <i data-lucide="briefcase"></i> Servis
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="pelanggan">
                            <i data-lucide="user"></i> Pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="motor">
                            <i data-lucide="bike"></i> Motor
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="mekanik">
                            <i data-lucide="user-check"></i> Mekanik
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="sparepart">
                            <i data-lucide="hexagon"></i> Sperpart
                        </a>
                    </li>
                    <li>
                        <a href="#" class="admin-sidebar-link" data-tab="transaksi">
                            <i data-lucide="wallet"></i> Transaksi
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="admin-sidebar-bottom" style="display:flex; flex-direction:column; gap:16px;">
                <!-- Theme Toggle inside Sidebar -->
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Theme" style="width:100%; border-radius:var(--radius-sm); height:45px; gap:8px; display:inline-flex; justify-content:center; align-items:center;">
                    <span class="moon-icon">
                        <i data-lucide="moon" style="width:16px; height:16px;"></i> Mode Gelap
                    </span>
                    <span class="sun-icon">
                        <i data-lucide="sun" style="width:16px; height:16px;"></i> Mode Terang
                    </span>
                </button>
                
                <a href="{{ route('admin.logout') }}" class="admin-sidebar-logout" style="display:flex; align-items:center; justify-content:center; gap:8px; padding:12px; background-color:#ef4444; color:#ffffff; font-weight:700; border-radius:var(--radius-sm); transition:background-color var(--transition-fast); text-decoration:none;">
                    <i data-lucide="log-out" style="width:16px; height:16px;"></i> Keluar
                </a>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
