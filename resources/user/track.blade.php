@extends('layouts.app')

@section('title', 'Lacak Status Servis Motor - Real-time Tracking')
@section('meta_description', 'Lacak status pengerjaan servis motor Anda secara real-time. Cukup masukkan kode booking atau nomor WhatsApp Anda.')

@section('content')
    <!-- Main Section -->
    <main class="section" style="padding-top: 140px; min-height: 80vh;">
        <div class="container">
            <div class="section-title-wrapper" style="margin-bottom: 20px;">
                <span class="section-tag">Status Real-time</span>
                <h2 class="section-title">Lacak Servis Motor</h2>
                <p class="section-desc">Masukkan Kode Booking Anda atau Nomor WhatsApp untuk memantau proses perbaikan sepeda motor Anda.</p>
            </div>

            <!-- Search Area -->
            <div style="max-width: 600px; margin: 0 auto;">
                <form action="{{ route('track.index') }}" method="GET" class="track-search-box">
                    <input type="text" name="code" placeholder="Masukkan Kode Booking (SVM-...) atau No. HP" value="{{ $search_query ?? '' }}" required>
                    <button type="submit" class="btn btn-primary">
                        Cari <i data-lucide="search"></i>
                    </button>
                </form>

                @if($searched && !empty($error))
                    <!-- Search Error -->
                    <div style="background-color: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 16px; border-radius: var(--radius-md); border: 1px solid rgba(239, 68, 68, 0.2); margin-top: 24px; text-align: center; font-weight: 600;">
                        <i data-lucide="alert-triangle" style="width:20px; height:20px; display:inline-block; vertical-align:middle; margin-right:8px;"></i>
                        {{ $error }}
                    </div>
                @endif

                @if($searched && $search_type === 'phone' && !empty($phone_bookings) && count($phone_bookings) > 0)
                    <!-- Phone Bookings List -->
                    <div class="form-box" style="max-width: 100%; margin-top: 24px; padding: 30px;">
                        <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; border-left: 4px solid var(--accent); padding-left: 10px;">Riwayat Booking Ditemukan</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            @foreach($phone_bookings as $pb)
                                <div style="background-color: var(--bg-tertiary); padding: 18px; border-radius: var(--radius-md); border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
                                    <div>
                                        <div style="font-family: var(--font-heading); font-weight: 800; color: var(--accent);">{{ $pb->booking_code }}</div>
                                        <div style="font-weight: 600; font-size: 0.95rem; margin-top: 4px;">{{ $pb->motor_brand }} {{ $pb->motor_model }} ({{ $pb->license_plate }})</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">{{ $pb->service_type }} | Jadwal: {{ $pb->service_date }}</div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <!-- Custom logic for status badge display in Blade -->
                                        @if($pb->status === 'Diterima')
                                            <span class="status-badge status-received">Diterima</span>
                                        @elseif($pb->status === 'Antrean')
                                            <span class="status-badge status-queued">Antrean</span>
                                        @elseif($pb->status === 'Dikerjakan')
                                            <span class="status-badge status-progress">Dikerjakan</span>
                                        @elseif($pb->status === 'Selesai')
                                            <span class="status-badge status-completed">Selesai</span>
                                        @elseif($pb->status === 'Sudah Diambil')
                                            <span class="status-badge status-pickedup">Sudah Diambil</span>
                                        @else
                                            <span class="status-badge status-unknown">{{ $pb->status }}</span>
                                        @endif
                                        
                                        <a href="{{ route('track.index', ['code' => $pb->booking_code]) }}" class="btn btn-secondary btn-sm" style="padding: 6px 12px;">
                                            Detail <i data-lucide="chevron-right" style="width:14px; height:14px;"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($searched && $search_type === 'code' && $booking)
                    <!-- Code Booking Status Details & Timeline -->
                    
                    <!-- 1. Booking Info Summary -->
                    <div class="tracking-summary-card" style="margin-top: 32px;">
                        <div class="summary-header">
                            <div>
                                <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; display: block;">KODE BOOKING</span>
                                <span class="summary-code">{{ $booking->booking_code }}</span>
                            </div>
                            <div>
                                @if($booking->status === 'Diterima')
                                    <span class="status-badge status-received">Diterima</span>
                                @elseif($booking->status === 'Antrean')
                                    <span class="status-badge status-queued">Antrean</span>
                                @elseif($booking->status === 'Dikerjakan')
                                    <span class="status-badge status-progress">Dikerjakan</span>
                                @elseif($booking->status === 'Selesai')
                                    <span class="status-badge status-completed">Selesai</span>
                                @elseif($booking->status === 'Sudah Diambil')
                                    <span class="status-badge status-pickedup">Sudah Diambil</span>
                                @else
                                    <span class="status-badge status-unknown">{{ $booking->status }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="summary-grid">
                            <div class="summary-item">
                                <label>Nama Pemilik</label>
                                <p>{{ $booking->name }}</p>
                            </div>
                            <div class="summary-item">
                                <label>Sepeda Motor</label>
                                <p>{{ $booking->motor_brand }} {{ $booking->motor_model }} ({{ $booking->license_plate }})</p>
                            </div>
                            <div class="summary-item">
                                <label>Jenis Layanan</label>
                                <p>{{ $booking->service_type }}</p>
                            </div>
                            <div class="summary-item">
                                <label>Jadwal Kedatangan</label>
                                <p>{{ $booking->service_date }} @ {{ $booking->service_time }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Cost & Mechanic Notes Card -->
                    @if($booking->total_cost > 0 || !empty($booking->mechanic_notes))
                        <div style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--card-shadow); margin-bottom: 32px;">
                            <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                <i data-lucide="clipboard-list" style="color: var(--accent);"></i> Hasil Diagnosa & Biaya
                            </h3>
                            
                            @if(!empty($booking->mechanic_notes))
                                <div style="background-color: var(--bg-tertiary); padding: 16px; border-radius: var(--radius-md); border-left: 4px solid var(--accent); margin-bottom: 16px;">
                                    <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; display: block; margin-bottom: 4px;">CATATAN MEKANIK / KELUHAN TERKINI:</span>
                                    <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-primary); font-style: italic;">
                                        "{{ $booking->mechanic_notes }}"
                                    </p>
                                </div>
                            @endif
                            
                            @if($booking->total_cost > 0)
                                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 8px; border-top: 1px solid var(--border-color);">
                                    <span style="font-weight: 700; color: var(--text-secondary);">Total Biaya Pengerjaan:</span>
                                    <span style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: var(--accent);">{{ $booking->formatted_cost }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- 3. Timeline Progress Tracking Graphic -->
                    <div style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--card-shadow);">
                        <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                            Alur Proses Pengerjaan
                        </h3>
                        
                        @php
                        $statuses = ['Diterima', 'Antrean', 'Dikerjakan', 'Selesai', 'Sudah Diambil'];
                        $current_status = $booking->status;
                        $current_index = array_search($current_status, $statuses);
                        if ($current_index === false) $current_index = 0;
                        
                        $step_details = [
                            'Diterima' => [
                                'title' => 'Booking Diterima',
                                'desc' => 'Admin telah meregistrasi booking servis Anda. Silakan datang sesuai jadwal.'
                            ],
                            'Antrean' => [
                                'title' => 'Dalam Antrean',
                                'desc' => 'Sepeda motor Anda telah sampai di bengkel dan sedang masuk dalam daftar antrean.'
                            ],
                            'Dikerjakan' => [
                                'title' => 'Sedang Dikerjakan',
                                'desc' => 'Mekanik kami sedang melakukan pembongkaran, perbaikan, dan uji kelayakan sepeda motor.'
                            ],
                            'Selesai' => [
                                'title' => 'Selesai & Siap Diambil',
                                'desc' => 'Perawatan selesai dilakukan. Silakan datang ke kasir untuk pembayaran dan serah terima unit.'
                            ],
                            'Sudah Diambil' => [
                                'title' => 'Unit Sudah Diambil',
                                'desc' => 'Transaksi selesai. Terima kasih telah mempercayakan perawatan motor Anda di bengkel kami!'
                            ]
                        ];
                        @endphp

                        <div class="timeline">
                            @foreach($statuses as $index => $stat)
                                @php
                                $class = '';
                                if ($index < $current_index) {
                                    $class = 'completed';
                                } elseif ($index == $current_index) {
                                    $class = 'active';
                                }
                                @endphp
                                <div class="timeline-step {{ $class }}">
                                    <div class="timeline-bullet"></div>
                                    <div class="timeline-content">
                                        <h4>
                                            {{ $step_details[$stat]['title'] }}
                                            @if($class === 'active')
                                                <i class="pulse-indicator" style="display:inline-block; width:8px; height:8px; background-color:var(--accent); border-radius:50%; box-shadow: 0 0 10px var(--accent);"></i>
                                            @endif
                                        </h4>
                                        <p>{{ $step_details[$stat]['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
