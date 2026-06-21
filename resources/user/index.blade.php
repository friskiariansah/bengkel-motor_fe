@extends('layouts.app')

@section('title', 'Servis Motor - Layanan Bengkel Motor Profesional & Booking Online')
@section('meta_description', 'Booking servis motor Anda secara online di Bengkel Servis Motor. Layanan tune up, ganti oli, servis rem, kelistrikan, dan turun mesin dengan mekanik berpengalaman.')

@section('content')
    <!-- Hero Section -->
    <header class="hero-centered" style="background-color: #4c46bb; color: #ffffff; padding: 100px 20px; text-align: center;">
        <div class="container" style="max-width: 800px;">
            <h1 class="hero-title" style="font-family: var(--font-heading); font-size: 3rem; font-weight: 800; line-height: 1.2; margin-bottom: 24px; color: #ffffff;">
                Servis Motor Profesional & <span style="color: #c4a51e;">Terpercaya</span>
            </h1>
            <p class="hero-desc" style="font-size: 1.15rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 0; line-height: 1.6; max-width: 650px; margin-left: auto; margin-right: auto;">
                Kami menyediakan layanan perawatan dan perbaikan motor dengan teknisi berpengalaman dan peralatan modern.
            </p>
        </div>
    </header>

    <!-- Why Choose Us Section -->
    <section class="section" style="background-color: #ffffff; padding: 80px 0;">
        <div class="container">
            <div class="section-title-wrapper" style="text-align: center; margin-bottom: 50px;">
                <h2 class="section-title" style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Mengapa Pilih Kami?</h2>
            </div>
            
            <div class="features-2x2-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; max-width: 900px; margin: 0 auto;">
                <!-- Feature 1 -->
                <div class="feature-card-premium" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; align-items: center; text-align: center; transition: all var(--transition-normal);">
                    <div style="width: 54px; height: 54px; border-radius: 50%; background-color: var(--accent-light); color: #4c46bb; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i data-lucide="wrench" style="width: 24px; height: 24px;"></i>
                    </div>
                    <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Teknisi Profesional</h3>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5; margin: 0;">Teknisi bersertifikat dan berpengalaman di bidangnya.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card-premium" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; align-items: center; text-align: center; transition: all var(--transition-normal);">
                    <div style="width: 54px; height: 54px; border-radius: 50%; background-color: var(--accent-light); color: #4c46bb; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i data-lucide="settings" style="width: 24px; height: 24px;"></i>
                    </div>
                    <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Sparepart Original</h3>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5; margin: 0;">Menyediakan suku cadang asli dan berkualitas tinggi.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card-premium" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; align-items: center; text-align: center; transition: all var(--transition-normal);">
                    <div style="width: 54px; height: 54px; border-radius: 50%; background-color: var(--accent-light); color: #4c46bb; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i data-lucide="zap" style="width: 24px; height: 24px;"></i>
                    </div>
                    <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Layanan Cepat</h3>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5; margin: 0;">Pengerjaan tepat waktu sesuai dengan jadwal yang disepakati.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card-premium" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; align-items: center; text-align: center; transition: all var(--transition-normal);">
                    <div style="width: 54px; height: 54px; border-radius: 50%; background-color: var(--accent-light); color: #4c46bb; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i data-lucide="calendar" style="width: 24px; height: 24px;"></i>
                    </div>
                    <h3 style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">Booking Online</h3>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5; margin: 0;">Pemesanan praktis secara online kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section" style="background-color: #f8fafc; padding: 80px 0;">
        <div class="container">
            <div class="section-title-wrapper" style="text-align: center; margin-bottom: 50px;">
                <h2 class="section-title" style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Layanan Kami</h2>
            </div>
            
            <div class="services-3col-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 1100px; margin: 0 auto 40px auto;">
                <!-- Service 1 -->
                <div class="service-card-flat" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 40px 30px; text-align: center; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.4rem; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Servis Rutin</h3>
                        <p style="font-size: 0.95rem; color: #64748b; line-height: 1.6; margin-bottom: 24px;">Layanan perawatan rutin berkala untuk menjaga performa motor Anda tetap optimal.</p>
                    </div>
                    <div style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 800; color: #4c46bb; margin-top: auto;">Mulai dari Rp 50.000</div>
                </div>

                <!-- Service 2 -->
                <div class="service-card-flat" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 40px 30px; text-align: center; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.4rem; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Perbaikan Mesin</h3>
                        <p style="font-size: 0.95rem; color: #64748b; line-height: 1.6; margin-bottom: 24px;">Penanganan masalah mesin berat, overhaul, ganti piston, ring piston, stang seher, dll.</p>
                    </div>
                    <div style="font-family: var(--font-heading); font-size: 1.2rem; font-weight: 800; color: #4c46bb; margin-top: auto;">Mulai dari Rp 150.000</div>
                </div>

                <!-- Service 3 -->
                <div class="service-card-flat" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 40px 30px; text-align: center; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.4rem; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Ganti Sparepart</h3>
                        <p style="font-size: 0.95rem; color: #64748b; line-height: 1.6; margin-bottom: 24px;">Penyediaan dan pemasangan suku cadang motor orisinal demi keandalan berkendara.</p>
                    </div>
                    <div style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: #4c46bb; margin-top: auto;">Tersedia berbagai suku cadang berkualitas</div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('layanan') }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 14px 32px; border-radius: var(--radius-sm); font-size: 1rem; text-decoration: none; display: inline-block; box-shadow: 0 4px 12px rgba(76, 70, 187, 0.25); transition: all var(--transition-fast);">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="section" style="background-color: #4c46bb; color: #ffffff; padding: 80px 20px; text-align: center;">
        <div class="container" style="max-width: 700px;">
            <h2 style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; margin-bottom: 16px; color: #ffffff;">Siap Servis Motor Anda?</h2>
            <p style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 32px; line-height: 1.6;">
                Booking sekarang untuk mendapatkan layanan terbaik untuk motor Anda.
            </p>
            <a href="{{ route('booking.index') }}" class="btn" style="background-color: #ffffff; color: #4c46bb; font-family: var(--font-heading); font-weight: 700; padding: 14px 32px; border-radius: var(--radius-sm); font-size: 1rem; text-decoration: none; display: inline-block; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); transition: all var(--transition-fast);">
                Booking Sekarang
            </a>
        </div>
    </section>
@endsection
