@extends('layouts.app')

@section('title', 'Layanan Kami - Turbo Garage')
@section('meta_description', 'Kami menyediakan layanan perawatan dan perbaikan motor dengan teknisi berpengalaman dan peralatan modern.')

@section('content')
    <main class="section" style="padding-top: 140px; padding-bottom: 80px; min-height: 80vh; background-color: #f8fafc;">
        <div class="container">
            <div class="section-title-wrapper" style="text-align: center; margin-bottom: 50px;">
                <h2 class="section-title" style="font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Layanan Kami</h2>
                <p class="section-desc" style="font-size: 1.1rem; color: #64748b; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                    Kami menyediakan layanan perawatan dan perbaikan motor dengan teknisi berpengalaman dan peralatan modern.
                </p>
            </div>
            
            <div class="services-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; max-width: 1100px; margin: 0 auto 60px auto;">
                <!-- Card 1 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Servis Rutin</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 50.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Ganti oli mesin</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Tune up karburator/injeksi</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Bersihkan filter udara</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cek rantai & rem</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Tune Up Rutin']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Ganti Oli</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 45.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Ganti oli mesin</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Ganti oli gardan (matic)</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cek filter oli</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Pembuangan oli bekas aman</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Ganti Oli & Cairan']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Tune Up</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 60.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Pembersihan CVT (matic)</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Setting karburator/injeksi</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cek busi & aki</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Uji performa mesin</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Tune Up Rutin']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>

                <!-- Card 4 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Perbaikan Mesin</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 150.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Turun mesin ringan/total</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Ganti piston/seher</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Perbaikan transmisi</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Garansi pengerjaan</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Turun Mesin (Overhaul)']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>

                <!-- Card 5 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Kelistrikan</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 40.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cek kelistrikan bodi</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Ganti lampu/klakson</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Perbaikan spul/regulator</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cek aki & sistem pengisian</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Sistem Kelistrikan']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>

                <!-- Card 6 -->
                <div class="service-card" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Cuci Motor</h3>
                        <div style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #4c46bb; margin-bottom: 20px;">Mulai dari Rp 20.000</div>
                        <ul style="list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 10px; text-align: left;">
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Cuci salju bersih</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Semprot kompresor</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Semir ban & bodi</li>
                            <li style="font-size: 0.95rem; color: #475569; display: flex; align-items: center; gap: 8px;"><i data-lucide="check" style="width: 16px; height: 16px; color: #22c55e;"></i> Pengecekan visual gratis</li>
                        </ul>
                    </div>
                    <a href="{{ route('booking.index', ['service' => 'Paket Servis Lengkap']) }}" class="btn" style="background-color: #4c46bb; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 12px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; text-align: center; display: block; box-shadow: 0 4px 10px rgba(76, 70, 187, 0.2); transition: all var(--transition-fast);">
                        Hubungi Layanan Ini
                    </a>
                </div>
            </div>

            <!-- Konsultasi Section -->
            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-lg); padding: 40px; text-align: center; max-width: 900px; margin: 0 auto; box-shadow: var(--card-shadow);">
                <h3 style="font-family: var(--font-heading); font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 12px;">Butuh Konsultasi?</h3>
                <p style="font-size: 1rem; color: #64748b; margin-bottom: 28px; line-height: 1.6; max-width: 500px; margin-left: auto; margin-right: auto;">
                    Silakan hubungi WhatsApp kami untuk konsultasi mengenai masalah motor Anda.
                </p>
                <a href="https://api.whatsapp.com/send?phone=6281234567890&text=Halo%20Turbo%20Garage,%20saya%20ingin%20konsultasi%20mengenai%20servis%20motor%20saya." target="_blank" class="btn" style="background-color: #25d366; color: #ffffff; font-family: var(--font-heading); font-weight: 700; padding: 14px 32px; border-radius: var(--radius-sm); font-size: 1rem; text-decoration: none; display: inline-block; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.25); transition: all var(--transition-fast);">
                    <i data-lucide="message-circle" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i> Hubungi Whatsapp Kami
                </a>
            </div>
        </div>
    </main>
@endsection
