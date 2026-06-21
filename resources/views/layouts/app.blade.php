<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Servis Motor - Layanan Bengkel Motor Profesional & Booking Online')</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="@yield('meta_description', 'Booking servis motor Anda secara online di Bengkel Servis Motor. Layanan tune up, ganti oli, servis rem, kelistrikan, dan turun mesin.')">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>

    <!-- Navigation Header -->
    <nav class="navbar" id="navbar">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo" id="nav-logo" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                <img src="{{ asset('assets/logo.png') }}" alt="Turbo Garage" style="width: 45px; height: 45px; object-fit: contain; flex-shrink: 0;">
                <div style="display:flex; flex-direction:column; text-align:left; font-family:'Outfit', sans-serif; font-size:1.15rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em;">
                    <span style="color:#ffffff; text-transform:none;">Turbo</span>
                    <span style="color:#c4a51e; text-transform:none;">Garage</span>
                </div>
            </a>
            
            <ul class="nav-menu" id="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}" id="link-home">BERANDA</a></li>
                <li><a href="{{ route('layanan') }}" class="nav-link {{ Route::is('layanan') ? 'active' : '' }}" id="link-services">LAYANAN</a></li>
                <li><a href="{{ route('booking.index') }}" class="nav-link {{ Route::is('booking.index') ? 'active' : '' }}" id="link-booking">BOOKING</a></li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link" id="link-admin">ADMIN</a></li>
                    @else
                        <li><a href="{{ route('user.dashboard') }}" class="nav-link {{ Route::is('user.dashboard') ? 'active' : '' }}" id="link-dashboard">DASHBOARD</a></li>
                        <li><span class="nav-link" style="color: var(--accent); font-weight: 700;">HALO, {{ strtoupper(auth()->user()->username) }}</span></li>
                        <li><a href="{{ route('admin.logout') }}" class="nav-link" id="link-logout">KELUAR</a></li>
                    @endif
                @else
                    <li><a href="{{ route('admin.login') }}" class="nav-link" id="link-login">MASUK</a></li>
                @endauth
            </ul>
            
            <div class="nav-actions">
                <!-- Theme Toggle (Hidden by default to match Figma, but kept in DOM for accessibility) -->
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle Theme" style="display: none;">
                    <i data-lucide="moon" class="moon-icon"></i>
                    <i data-lucide="sun" class="sun-icon"></i>
                </button>
                
                <!-- Mobile Menu Button -->
                <button class="menu-btn" id="menu-btn" aria-label="Open Menu">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </nav>
 
    <!-- Main Content Slot -->
    @yield('content')
 
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-widget">
                    <a href="{{ route('home') }}" class="logo" style="margin-bottom: 20px; display:flex; align-items:center; gap:12px; text-decoration:none;">
                        <img src="{{ asset('assets/logo.png') }}" alt="Turbo Garage" style="width: 45px; height: 45px; object-fit: contain; flex-shrink: 0;">
                        <div style="display:flex; flex-direction:column; text-align:left; font-family:'Outfit', sans-serif; font-size:1.15rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em;">
                            <span style="color:#ffffff; text-transform:none;">Turbo</span>
                            <span style="color:#c4a51e; text-transform:none;">Garage</span>
                        </div>
                    </a>
                    <p style="margin-bottom: 16px;">Layanan servis dan perawatan motor premium yang mengedepankan kualitas, transparansi, dan efisiensi waktu Anda.</p>
                </div>
                
                <div class="footer-widget">
                    <h3>Navigasi</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('layanan') }}">Layanan</a></li>
                        <li><a href="{{ route('booking.index') }}">Booking</a></li>
                        <li><a href="{{ route('admin.login') }}">Panel Admin</a></li>
                    </ul>
                </div>
                
                <div class="footer-widget">
                    <h3>Jam Operasional</h3>
                    <ul class="footer-links" style="color: var(--text-secondary);">
                        <li style="display:flex; align-items:center; gap:8px;"><i data-lucide="clock" style="width:16px; color:var(--accent);"></i> Senin - Sabtu: 08:00 - 17:00</li>
                        <li style="display:flex; align-items:center; gap:8px;"><i data-lucide="calendar" style="width:16px; color:var(--accent);"></i> Minggu: Tutup</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom flex-between">
                <p>&copy; {{ date('Y') }} Turbo Garage. Hak Cipta Dilindungi.</p>
                <p>Designed for Riders</p>
            </div>
        </div>
    </footer>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Script JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
