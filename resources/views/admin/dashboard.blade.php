@extends('layouts.admin')

@section('title', 'Panel Admin - Servis Motor Dashboard')

@section('styles')
    <!-- Chart.js CDN for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .admin-nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .admin-user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            background-color: var(--bg-secondary);
            padding: 6px 16px;
            border-radius: var(--radius-full);
            border: 1px solid var(--border-color);
        }
        .admin-user-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: var(--accent);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .tab-pane {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        .tab-pane.active {
            display: block;
        }
        .tab-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }
        .tab-title-group h1 {
            font-family: var(--font-heading);
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text-primary);
        }
        .tab-title-group p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        .tab-controls {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }
        .tab-search-input {
            padding: 10px 16px;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            width: 280px;
            color: var(--text-primary);
            transition: border-color var(--transition-fast);
        }
        .tab-search-input:focus {
            border-color: var(--accent);
            outline: none;
        }
        .chart-container {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--card-shadow);
            margin-bottom: 32px;
        }
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .chart-header h3 {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 700;
            text-transform: lowercase;
        }
        .admin-dashboard-wrapper {
            padding-bottom: 40px;
        }
        .status-badge-outline {
            border: 1px solid;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-active { border-color: #4ade80; color: #4ade80; background-color: rgba(74, 222, 128, 0.05); }
        .status-closed { border-color: #ef4444; color: #ef4444; background-color: rgba(239, 68, 68, 0.05); }
        .status-busy { border-color: #f59e0b; color: #f59e0b; background-color: rgba(245, 158, 11, 0.05); }
        .status-paid { border-color: #10b981; color: #10b981; background-color: rgba(16, 185, 129, 0.05); }
        .status-unpaid { border-color: #f43f5e; color: #f43f5e; background-color: rgba(244, 63, 94, 0.05); }
        .action-icon-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all var(--transition-fast);
        }
        .action-icon-btn:hover {
            color: var(--accent);
            background-color: var(--bg-tertiary);
        }
        .action-icon-btn.btn-delete:hover {
            color: #ef4444;
        }
    </style>
@endsection

@section('content')
    <div class="admin-dashboard-wrapper">
        
        <!-- Alerts -->
        @if(session('success'))
            <div style="background-color: rgba(74, 222, 128, 0.15); color: #4ade80; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid rgba(74, 222, 128, 0.2); margin-bottom: 24px; font-weight: 600; font-size: 0.9rem;">
                <i data-lucide="check-circle" style="width:16px; height:16px; display:inline-block; vertical-align:middle; margin-right:6px;"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- ==================== TAB: DASHBOARD ==================== -->
        <div class="tab-pane active" id="pane-dashboard">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Dashboard</h1>
                    <p>Statistik dan aktivitas terbaru bengkel motor Anda.</p>
                </div>
                <div class="admin-user-info">
                    <div class="admin-user-avatar">A</div>
                    <span>{{ Auth::user()->username }}</span>
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="admin-stats-grid">
                <div class="stat-card">
                    <div class="stat-card-icon" style="background-color: var(--accent-light); color: var(--accent);">
                        <i data-lucide="store"></i>
                    </div>
                    <div class="stat-card-info">
                        <h3>{{ $total_branches }}</h3>
                        <p style="text-transform: lowercase;">total cabang</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="background-color: rgba(96, 165, 250, 0.15); color: #60a5fa;">
                        <i data-lucide="users"></i>
                    </div>
                    <div class="stat-card-info">
                        <h3>{{ $total_customers }}</h3>
                        <p style="text-transform: lowercase;">total pelanggan</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="background-color: rgba(245, 158, 11, 0.15); color: #f59e0b;">
                        <i data-lucide="user-check"></i>
                    </div>
                    <div class="stat-card-info">
                        <h3>{{ $total_mechanics }}</h3>
                        <p style="text-transform: lowercase;">total mekanik</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="background-color: rgba(74, 222, 128, 0.15); color: #4ade80;">
                        <i data-lucide="package"></i>
                    </div>
                    <div class="stat-card-info">
                        <h3>{{ $total_spareparts }}</h3>
                        <p style="text-transform: lowercase;">total sparepart</p>
                    </div>
                </div>
            </div>

            <!-- Activity Chart Section -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>grafik pendapatan</h3>
                    <span style="font-size: 0.85rem; color: var(--text-secondary);">Statistik Mingguan</span>
                </div>
                <div style="height: 300px; width: 100%;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Latest Queue Table -->
            <div class="admin-table-container">
                <div class="table-header-bar flex-between">
                    <h2 style="text-transform: lowercase;">layanan terbaru</h2>
                    <input type="text" class="tab-search-input" data-target-table="table-recent-bookings" placeholder="Cari layanan terbaru..." style="width: 220px; padding: 6px 12px; margin: 0;">
                </div>
                <div class="table-responsive">
                    <table class="admin-table" id="table-recent-bookings">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Motor</th>
                                <th>Status</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings->take(5) as $index => $b)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:600;">{{ $b->name }}</td>
                                    <td>{{ $b->motor_brand }} {{ $b->motor_model }}</td>
                                    <td>
                                        @if($b->status === 'Diterima')
                                            <span class="status-badge status-received">Diterima</span>
                                        @elseif($b->status === 'Antrean')
                                            <span class="status-badge status-queued">Antrean</span>
                                        @elseif($b->status === 'Dikerjakan')
                                            <span class="status-badge status-progress">Dikerjakan</span>
                                        @elseif($b->status === 'Selesai')
                                            <span class="status-badge status-completed">Selesai</span>
                                        @elseif($b->status === 'Sudah Diambil')
                                            <span class="status-badge status-pickedup">Sudah Diambil</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 700; color: var(--text-primary);">
                                        {{ $b->total_cost > 0 ? $b->formatted_cost : 'Rp 0' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada layanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: CABANG ==================== -->
        <div class="tab-pane" id="pane-cabang">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Cabang</h1>
                    <p>Daftar cabang operasional bengkel.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-branches" placeholder="Cari cabang...">
                    <button class="btn btn-primary btn-sm" id="btn-add-branch">
                        + tambah cabang
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-branches">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
                                <th>No Handphone</th>
                                <th>Penanggung Jawab</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $index => $c)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight: 700;">{{ $c->name }}</td>
                                    <td>{{ $c->address }}</td>
                                    <td>{{ $c->phone }}</td>
                                    <td style="font-weight: 600;">{{ $c->pic ?: '-' }}</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-branch-btn" 
                                                    data-id="{{ $c->id }}"
                                                    data-name="{{ $c->name }}"
                                                    data-address="{{ $c->address }}"
                                                    data-phone="{{ $c->phone }}"
                                                    data-pic="{{ $c->pic }}"
                                                    data-status="{{ $c->status }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.branches.delete') }}" method="POST" onsubmit="return confirm('Hapus cabang ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $c->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada cabang terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: BOOKING ==================== -->
        <div class="tab-pane" id="pane-booking">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Booking</h1>
                    <p>Daftar antrean booking servis motor.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-bookings" placeholder="Cari booking...">
                    <button class="btn btn-primary btn-sm" id="btn-add-booking">
                        + tambah booking
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-bookings">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Motor</th>
                                <th>Cabang</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $b)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:600;">{{ $b->name }}</td>
                                    <td>{{ $b->motor_brand }} {{ $b->motor_model }}</td>
                                    <td style="font-weight:600; color:var(--accent);">{{ $b->branch ?: 'Cabang Utama' }}</td>
                                    <td>{{ $b->service_date }}</td>
                                    <td>
                                        @if($b->status === 'Diterima')
                                            <span class="status-badge status-received">Diterima</span>
                                        @elseif($b->status === 'Antrean')
                                            <span class="status-badge status-queued">Antrean</span>
                                        @elseif($b->status === 'Dikerjakan')
                                            <span class="status-badge status-progress">Dikerjakan</span>
                                        @elseif($b->status === 'Selesai')
                                            <span class="status-badge status-completed">Selesai</span>
                                        @elseif($b->status === 'Sudah Diambil')
                                            <span class="status-badge status-pickedup">Sudah Diambil</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-booking-info-btn" 
                                                    data-id="{{ $b->id }}"
                                                    data-name="{{ $b->name }}"
                                                    data-phone="{{ $b->phone }}"
                                                    data-brand="{{ $b->motor_brand }}"
                                                    data-model="{{ $b->motor_model }}"
                                                    data-branch="{{ $b->branch }}"
                                                    data-plate="{{ $b->license_plate }}"
                                                    data-type="{{ $b->service_type }}"
                                                    data-date="{{ $b->service_date }}"
                                                    data-time="{{ $b->service_time }}"
                                                    data-complaints="{{ $b->complaints }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.bookings.delete') }}" method="POST" onsubmit="return confirm('Hapus booking ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $b->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada data booking.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: SERVIS ==================== -->
        <div class="tab-pane" id="pane-servis">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Servis</h1>
                    <p>Status pengerjaan servis motor hari ini.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-servis" placeholder="Cari servis...">
                    <button class="btn btn-primary btn-sm" id="btn-add-servis">
                        + tambah servis
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-servis">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama</th>
                                <th>Motor</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $b)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight: 800; color: var(--accent);">{{ $b->booking_code }}</td>
                                    <td style="font-weight:600;">{{ $b->name }}</td>
                                    <td>{{ $b->motor_brand }} {{ $b->motor_model }}</td>
                                    <td>
                                        @if($b->status === 'Diterima')
                                            <span class="status-badge status-received">Diterima</span>
                                        @elseif($b->status === 'Antrean')
                                            <span class="status-badge status-queued">Antrean</span>
                                        @elseif($b->status === 'Dikerjakan')
                                            <span class="status-badge status-progress">Dikerjakan</span>
                                        @elseif($b->status === 'Selesai')
                                            <span class="status-badge status-completed">Selesai</span>
                                        @elseif($b->status === 'Sudah Diambil')
                                            <span class="status-badge status-pickedup">Sudah Diambil</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm edit-booking-btn" 
                                                data-id="{{ $b->id }}"
                                                data-code="{{ $b->booking_code }}"
                                                data-name="{{ $b->name }}"
                                                data-status="{{ $b->status }}"
                                                data-notes="{{ $b->mechanic_notes }}"
                                                data-cost="{{ $b->total_cost }}">
                                            <i data-lucide="edit-2"></i> Update Progres
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada progres servis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: TRANSAKSI ==================== -->
        <div class="tab-pane" id="pane-transaksi">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Transaksi</h1>
                    <p>Invoicing dan pembayaran kasir servis.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-transaksi" placeholder="Cari transaksi...">
                    <button class="btn btn-primary btn-sm" id="btn-add-transaksi">
                        + tambah transaksi
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $index => $b)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight: 800; color: var(--accent);">{{ $b->booking_code }}</td>
                                    <td style="font-weight:600;">{{ $b->name }}</td>
                                    <td>{{ $b->service_date }}</td>
                                    <td style="font-weight: 800; color: var(--text-primary);">
                                        {{ \App\Models\Booking::formatRupiah($b->total_cost) }}
                                    </td>
                                    <td>
                                        @if($b->status === 'Sudah Diambil')
                                            <span class="status-badge-outline status-paid">Lunas</span>
                                        @else
                                            <span class="status-badge-outline status-unpaid">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        $wa_phone = $b->phone;
                                        if (str_starts_with($wa_phone, '0')) { $wa_phone = '62' . substr($wa_phone, 1); }
                                        $wa_message = "Halo " . $b->name . ", transaksi servis Anda dengan No Transaksi *" . $b->booking_code . "* telah dicatat. Total Biaya: " . \App\Models\Booking::formatRupiah($b->total_cost) . ". Status: " . ($b->status === 'Sudah Diambil' ? 'Lunas' : 'Belum Lunas') . ". Terima kasih.";
                                        $wa_url = "https://api.whatsapp.com/send?phone=" . urlencode($wa_phone) . "&text=" . urlencode($wa_message);
                                        @endphp
                                        <div style="display: flex; gap: 8px;">
                                            <a href="{{ $wa_url }}" target="_blank" class="btn btn-secondary btn-sm" style="background-color:#25d366; color:white; border-color:#25d366; font-weight:700; display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px;">
                                                <i data-lucide="message-square" style="width: 14px; height: 14px;"></i> WA
                                            </a>
                                            <button class="btn btn-primary btn-sm show-invoice-btn" 
                                                    data-code="{{ $b->booking_code }}"
                                                    data-date="{{ $b->service_date }}"
                                                    data-name="{{ $b->name }}"
                                                    data-phone="{{ $b->phone }}"
                                                    data-service="{{ $b->service_type }}"
                                                    data-cost="{{ $b->total_cost }}"
                                                    data-status="{{ $b->status }}"
                                                    data-branch="{{ $b->branch ?: 'Cabang Utama' }}"
                                                    data-complaints="{{ $b->complaints ?: 'Terima kasih' }}"
                                                    style="background-color: var(--accent); border-color: var(--accent); display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px;">
                                                <i data-lucide="file-text" style="width: 14px; height: 14px;"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: PELANGGAN ==================== -->
        <div class="tab-pane" id="pane-pelanggan">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Pelanggan</h1>
                    <p>Profil data pelanggan bengkel.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-customers" placeholder="Cari pelanggan...">
                    <button class="btn btn-primary btn-sm" id="btn-add-customer">
                        + tambah pelanggan
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-customers">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>No Handphone</th>
                                <th>Alamat</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $index => $c)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:700;">{{ $c->name }}</td>
                                    <td style="font-weight:600; color:var(--accent);">{{ $c->email }}</td>
                                    <td>{{ $c->phone }}</td>
                                    <td>{{ $c->address }}</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-customer-btn" 
                                                    data-id="{{ $c->id }}"
                                                    data-name="{{ $c->name }}"
                                                    data-email="{{ $c->email }}"
                                                    data-phone="{{ $c->phone }}"
                                                    data-address="{{ $c->address }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.customers.delete') }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $c->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada pelanggan terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: MOTOR ==================== -->
        <div class="tab-pane" id="pane-motor">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Motor</h1>
                    <p>Daftar motor pelanggan terdaftar.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-motors" placeholder="Cari motor...">
                    <button class="btn btn-primary btn-sm" id="btn-add-motor">
                        + tambah motor
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-motors">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>No Plat</th>
                                <th>Merek</th>
                                <th>Tipe</th>
                                <th>Tahun</th>
                                <th>Pemilik</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($motors as $index => $m)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:800; color:var(--accent); text-transform:uppercase;">{{ $m->license_plate }}</td>
                                    <td>{{ $m->brand }}</td>
                                    <td>{{ $m->type }}</td>
                                    <td>{{ $m->year }}</td>
                                    <td style="font-weight:600;">{{ $m->owner }}</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-motor-btn" 
                                                    data-id="{{ $m->id }}"
                                                    data-plate="{{ $m->license_plate }}"
                                                    data-brand="{{ $m->brand }}"
                                                    data-type="{{ $m->type }}"
                                                    data-year="{{ $m->year }}"
                                                    data-owner="{{ $m->owner }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.motors.delete') }}" method="POST" onsubmit="return confirm('Hapus motor ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $m->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada motor terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: MEKANIK ==================== -->
        <div class="tab-pane" id="pane-mekanik">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Mekanik</h1>
                    <p>Daftar tim mekanik beserta spesialisasi cabang.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-mechanics" placeholder="Cari mekanik...">
                    <button class="btn btn-primary btn-sm" id="btn-add-mechanic">
                        + tambah mekanik
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-mechanics">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Mekanik</th>
                                <th>No Handphone</th>
                                <th>Spesialisasi</th>
                                <th>Cabang</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mechanics as $index => $mc)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:700;">{{ $mc->name }}</td>
                                    <td>{{ $mc->phone ?: '-' }}</td>
                                    <td>{{ $mc->specialty }}</td>
                                    <td style="font-weight: 600; color:var(--accent);">{{ $mc->branch ?: 'Cabang Utama' }}</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-mechanic-btn" 
                                                    data-id="{{ $mc->id }}"
                                                    data-name="{{ $mc->name }}"
                                                    data-phone="{{ $mc->phone }}"
                                                    data-specialty="{{ $mc->specialty }}"
                                                    data-branch="{{ $mc->branch }}"
                                                    data-status="{{ $mc->status }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.mechanics.delete') }}" method="POST" onsubmit="return confirm('Hapus data mekanik ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $mc->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada data mekanik.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ==================== TAB: SPAREPART ==================== -->
        <div class="tab-pane" id="pane-sparepart">
            <div class="tab-header-row">
                <div class="tab-title-group">
                    <h1>Sparepart</h1>
                    <p>Inventarisasi suku cadang sparepart.</p>
                </div>
                <div class="tab-controls">
                    <input type="text" class="tab-search-input" data-target-table="table-spareparts" placeholder="Cari sparepart...">
                    <button class="btn btn-primary btn-sm" id="btn-add-sparepart">
                        + tambah sparepart
                    </button>
                </div>
            </div>

            <div class="admin-table-container">
                <div class="table-responsive">
                    <table class="admin-table" id="table-spareparts">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama Sparepart</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($spareparts as $index => $sp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td style="font-weight:700;">{{ $sp->name }}</td>
                                    <td style="font-family: monospace; font-size:1rem; color:var(--accent);">{{ $sp->code }}</td>
                                    <td style="font-weight: 600;">{{ $sp->category ?: 'Umum' }}</td>
                                    <td style="font-weight:700;">{{ $sp->stock }} Unit</td>
                                    <td style="font-weight:700; color:var(--text-primary);">{{ $sp->formatted_price }}</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <button class="action-icon-btn edit-sparepart-btn" 
                                                    data-id="{{ $sp->id }}"
                                                    data-name="{{ $sp->name }}"
                                                    data-code="{{ $sp->code }}"
                                                    data-category="{{ $sp->category }}"
                                                    data-stock="{{ $sp->stock }}"
                                                    data-price="{{ $sp->price }}">
                                                <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                            </button>
                                            <form action="{{ route('admin.spareparts.delete') }}" method="POST" onsubmit="return confirm('Hapus sparepart ini?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $sp->id }}">
                                                <button type="submit" class="action-icon-btn btn-delete">
                                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; color: var(--text-muted); padding: 40px;">Belum ada stok sparepart.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ==================== MODAL: UPDATE PROGRES BOOKING ==================== -->
    <div class="modal-overlay" id="edit-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Update Status Servis</h3>
                <div class="modal-close" onclick="closeModal('edit-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.update') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" id="modal-booking-id" value="">
                
                <div style="background-color: var(--bg-tertiary); padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); margin-bottom: 20px;">
                    <span style="font-size:0.75rem; color:var(--text-muted); font-weight:700; display:block;">PELANGGAN & KODE BOOKING:</span>
                    <span style="font-weight: 800; color: var(--accent); font-size:1.1rem;" id="modal-booking-code">SVM-XXX</span>
                    <span style="font-weight:600; color:var(--text-primary); margin-left:8px;" id="modal-booking-name">(Budi)</span>
                </div>
                
                <div class="form-group">
                    <label for="modal-status">Status Pengerjaan</label>
                    <select name="status" id="modal-status" class="form-control" required>
                        <option value="Diterima">Diterima</option>
                        <option value="Antrean">Antrean</option>
                        <option value="Dikerjakan">Dikerjakan</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Sudah Diambil">Sudah Diambil</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="modal-notes">Catatan Diagnosa Mekanik</label>
                    <textarea name="mechanic_notes" id="modal-notes" class="form-control" placeholder="Contoh: Ganti oli mesin MPX2, bersihkan mangkok kopling ganda..."></textarea>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="modal-cost">Total Biaya Servis (Rupiah)</label>
                    <input type="number" name="total_cost" id="modal-cost" class="form-control" placeholder="Contoh: 120000" min="0">
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('edit-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT CABANG ==================== -->
    <div class="modal-overlay" id="branch-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="branch-modal-title">Tambah Cabang Baru</h3>
                <div class="modal-close" onclick="closeModal('branch-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.branches.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="branch-id" value="">
                
                <div class="form-group">
                    <label for="branch-name">Nama Cabang</label>
                    <input type="text" name="name" id="branch-name" class="form-control" placeholder="Contoh: Cabang Depok" required>
                </div>
                
                <div class="form-group">
                    <label for="branch-address">Alamat Lengkap</label>
                    <input type="text" name="address" id="branch-address" class="form-control" placeholder="Contoh: Jl. Margonda Raya No. 45" required>
                </div>
                
                <div class="form-group">
                    <label for="branch-phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="branch-phone" class="form-control" placeholder="Contoh: 021-999888" required>
                </div>

                <div class="form-group">
                    <label for="branch-pic">Penanggung Jawab (PIC)</label>
                    <input type="text" name="pic" id="branch-pic" class="form-control" placeholder="Contoh: Ahmad Subarjo" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="branch-status">Status Operasional</label>
                    <select name="status" id="branch-status" class="form-control" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tutup">Tutup</option>
                    </select>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('branch-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Cabang</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT MEKANIK ==================== -->
    <div class="modal-overlay" id="mechanic-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="mechanic-modal-title">Tambah Mekanik Baru</h3>
                <div class="modal-close" onclick="closeModal('mechanic-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.mechanics.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="mechanic-id" value="">
                
                <div class="form-group">
                    <label for="mechanic-name">Nama Lengkap</label>
                    <input type="text" name="name" id="mechanic-name" class="form-control" placeholder="Contoh: Farhan Syah" required>
                </div>

                <div class="form-group">
                    <label for="mechanic-phone">Nomor Handphone</label>
                    <input type="text" name="phone" id="mechanic-phone" class="form-control" placeholder="Contoh: 081299998888" required>
                </div>
                
                <div class="form-group">
                    <label for="mechanic-specialty">Keahlian Spesialisasi</label>
                    <input type="text" name="specialty" id="mechanic-specialty" class="form-control" placeholder="Contoh: Injeksi & Kelistrikan" required>
                </div>

                <div class="form-group">
                    <label for="mechanic-branch">Penempatan Cabang</label>
                    <select name="branch" id="mechanic-branch" class="form-control" required>
                        <option value="">Pilih Cabang</option>
                        @foreach($branches as $c)
                            <option value="{{ $c->name }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="mechanic-status">Status Kehadiran</label>
                    <select name="status" id="mechanic-status" class="form-control" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Senggang">Senggang</option>
                        <option value="Sibuk">Sibuk</option>
                    </select>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('mechanic-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Mekanik</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT SPAREPART ==================== -->
    <div class="modal-overlay" id="sparepart-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="sparepart-modal-title">Tambah Sparepart</h3>
                <div class="modal-close" onclick="closeModal('sparepart-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.spareparts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="sparepart-id" value="">
                
                <div class="form-group">
                    <label for="sparepart-name">Nama Sparepart</label>
                    <input type="text" name="name" id="sparepart-name" class="form-control" placeholder="Contoh: Kampas Kopling Smash" required>
                </div>
                
                <div class="form-group">
                    <label for="sparepart-code">Kode Sparepart (Part Number)</label>
                    <input type="text" name="code" id="sparepart-code" class="form-control" placeholder="Contoh: SP-009" required>
                </div>

                <div class="form-group">
                    <label for="sparepart-category">Kategori Sparepart</label>
                    <input type="text" name="category" id="sparepart-category" class="form-control" placeholder="Contoh: Oli, Rem, Busi, Filter" required>
                </div>
                
                <div class="form-group">
                    <label for="sparepart-stock">Stok Awal</label>
                    <input type="number" name="stock" id="sparepart-stock" class="form-control" placeholder="Contoh: 10" min="0" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="sparepart-price">Harga Satuan (Rupiah)</label>
                    <input type="number" name="price" id="sparepart-price" class="form-control" placeholder="Contoh: 35000" min="0" required>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('sparepart-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Sparepart</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT BOOKING DETAILS ==================== -->
    <div class="modal-overlay" id="booking-modal">
        <div class="modal-box" style="max-width: 650px;">
            <div class="modal-header">
                <h3 id="booking-modal-title">Tambah Booking Baru</h3>
                <div class="modal-close" onclick="closeModal('booking-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="booking-id" value="">
                <input type="hidden" name="status" id="booking-status-hidden" value="Diterima">
                
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="booking-name">Nama Pelanggan</label>
                        <input type="text" name="name" id="booking-name" class="form-control" placeholder="Nama Pelanggan" required>
                    </div>
                    <div class="form-group">
                        <label for="booking-phone">Nomor WhatsApp</label>
                        <input type="text" name="phone" id="booking-phone" class="form-control" placeholder="Contoh: 0812345678" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="booking-brand">Merek Motor</label>
                        <select name="motor_brand" id="booking-brand" class="form-control" required>
                            <option value="Honda">Honda</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Kawasaki">Kawasaki</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="booking-model">Model Motor</label>
                        <input type="text" name="motor_model" id="booking-model" class="form-control" placeholder="Contoh: Beat CBS" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="booking-branch">Cabang Lokasi</label>
                        <select name="branch" id="booking-branch" class="form-control" required>
                            <option value="">Pilih Cabang</option>
                            @foreach($branches as $c)
                                <option value="{{ $c->name }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="booking-plate">Nomor Polisi</label>
                        <input type="text" name="license_plate" id="booking-plate" class="form-control" placeholder="Contoh: B 1234 ABC" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="booking-type">Jenis Layanan</label>
                        <select name="service_type" id="booking-type" class="form-control" required>
                            <option value="Tune Up Rutin">Tune Up Rutin</option>
                            <option value="Servis Lengkap">Servis Lengkap</option>
                            <option value="Ganti Oli & Filter">Ganti Oli & Filter</option>
                            <option value="Servis Rem & Kaki">Servis Rem & Kaki</option>
                            <option value="Turun Mesin / Overhaul">Turun Mesin / Overhaul</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="booking-date">Tanggal Servis</label>
                        <input type="date" name="service_date" id="booking-date" class="form-control" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="booking-time">Jam Servis</label>
                        <select name="service_time" id="booking-time" class="form-control" required>
                            <option value="08:00">08:00 WIB</option>
                            <option value="09:00">09:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="booking-complaints">Keluhan Utama</label>
                    <textarea name="complaints" id="booking-complaints" class="form-control" placeholder="Deskripsi keluhan..."></textarea>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end; margin-top:20px;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('booking-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT CUSTOMER ==================== -->
    <div class="modal-overlay" id="customer-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="customer-modal-title">Tambah Pelanggan Baru</h3>
                <div class="modal-close" onclick="closeModal('customer-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="customer-id" value="">
                
                <div class="form-group">
                    <label for="customer-name">Nama Pelanggan</label>
                    <input type="text" name="name" id="customer-name" class="form-control" placeholder="Contoh: Budi Setiawan" required>
                </div>
                
                <div class="form-group">
                    <label for="customer-email">Email</label>
                    <input type="email" name="email" id="customer-email" class="form-control" placeholder="Contoh: budi@example.com" required>
                </div>
                
                <div class="form-group">
                    <label for="customer-phone">No Handphone</label>
                    <input type="text" name="phone" id="customer-phone" class="form-control" placeholder="Contoh: 0812345678" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="customer-address">Alamat</label>
                    <textarea name="address" id="customer-address" class="form-control" placeholder="Contoh: Jl. Margonda Raya No. 45" required></textarea>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('customer-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL: ADD/EDIT MOTOR ==================== -->
    <div class="modal-overlay" id="motor-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="motor-modal-title">Tambah Motor Baru</h3>
                <div class="modal-close" onclick="closeModal('motor-modal')">
                    <i data-lucide="x"></i>
                </div>
            </div>
            
            <form action="{{ route('admin.motors.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="motor-id" value="">
                
                <div class="form-group">
                    <label for="motor-plate">No Plat</label>
                    <input type="text" name="license_plate" id="motor-plate" class="form-control" placeholder="Contoh: B 3142 KLO" required>
                </div>
                
                <div class="form-group">
                    <label for="motor-brand">Merek</label>
                    <input type="text" name="brand" id="motor-brand" class="form-control" placeholder="Contoh: Honda" required>
                </div>
                
                <div class="form-group">
                    <label for="motor-type">Tipe</label>
                    <input type="text" name="type" id="motor-type" class="form-control" placeholder="Contoh: Vario 150" required>
                </div>
                
                <div class="form-group">
                    <label for="motor-year">Tahun</label>
                    <input type="text" name="year" id="motor-year" class="form-control" placeholder="Contoh: 2018" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="motor-owner">Pemilik</label>
                    <select name="owner" id="motor-owner" class="form-control" required>
                        <option value="">Pilih Pemilik</option>
                        @foreach($customers as $c)
                            <option value="{{ $c->name }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div style="display:flex; gap:16px; justify-content:flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('motor-modal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Motor</button>
                </div>
            </form>
        </div>
    </div>
    <!-- ==================== MODAL: DETAIL INVOICE TRANSAKSI (Frame 427) ==================== -->
    <div class="modal-overlay" id="invoice-modal">
        <div class="modal-box" style="max-width: 600px; padding: 30px;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0; margin-bottom: 20px;">
                <h3 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0;" id="invoice-modal-title">Detail Transaksi #1001</h3>
                <div class="modal-close" onclick="closeModal('invoice-modal')" style="background-color: var(--bg-tertiary); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; text-align: left; font-size: 0.9rem;">
                <div>
                    <div style="margin-bottom: 12px;">
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Tanggal</span>
                        <span id="invoice-date" style="font-weight: 700; color: var(--text-primary);">2023-12-25</span>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Status</span>
                        <span id="invoice-status" style="font-weight: 700; color: #22c55e;">Sukses</span>
                    </div>
                    <div>
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Metode Pembayaran</span>
                        <span style="font-weight: 700; color: var(--text-primary);">Transfer Bank</span>
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 12px;">
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Pelanggan</span>
                        <span id="invoice-name" style="font-weight: 700; color: var(--text-primary);">Andi Pratama</span>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">No. HP</span>
                        <span id="invoice-phone" style="font-weight: 700; color: var(--text-primary);">081234567890</span>
                    </div>
                    <div>
                        <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Metode Servis</span>
                        <span style="font-weight: 700; color: var(--text-primary);">Datang Langsung</span>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 16px 0; margin-bottom: 24px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-secondary); font-weight: 700;">
                            <th style="padding-bottom: 10px;">Item</th>
                            <th style="text-align: center; padding-bottom: 10px;">Qty</th>
                            <th style="text-align: right; padding-bottom: 10px;">Harga</th>
                            <th style="text-align: right; padding-bottom: 10px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="color: var(--text-primary);">
                            <td id="invoice-item-name" style="padding: 12px 0; font-weight: 600;">Tune Up</td>
                            <td style="text-align: center; padding: 12px 0;">1</td>
                            <td id="invoice-item-price" style="text-align: right; padding: 12px 0;">60.000</td>
                            <td id="invoice-item-subtotal" style="text-align: right; padding: 12px 0;">60.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px; font-size: 0.9rem; margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; width: 200px; color: var(--text-secondary);">
                    <span>Subtotal:</span>
                    <span id="invoice-summary-subtotal" style="font-weight: 700; color: var(--text-primary);">60.000</span>
                </div>
                <div style="display: flex; justify-content: space-between; width: 200px; color: var(--text-secondary);">
                    <span>Diskon:</span>
                    <span style="font-weight: 700; color: #22c55e;">0</span>
                </div>
                <div style="display: flex; justify-content: space-between; width: 200px; font-size: 1.05rem; font-weight: 800; border-top: 1px solid var(--border-color); padding-top: 8px;">
                    <span style="color: var(--text-primary);">Total:</span>
                    <span id="invoice-summary-total" style="color: var(--accent);">60.000</span>
                </div>
            </div>

            <div style="text-align: left; font-size: 0.85rem; color: var(--text-secondary); background-color: var(--bg-tertiary); padding: 12px 16px; border-radius: var(--radius-sm); border-left: 3px solid var(--accent); margin-bottom: 30px;">
                <span style="font-weight: 700; display: block; margin-bottom: 4px;">Catatan:</span>
                <span id="invoice-note">Terima kasih telah mempercayakan servis motor Anda kepada kami.</span>
            </div>

            <div style="display: flex; gap: 16px; justify-content: flex-end;">
                <button type="button" class="btn btn-secondary" onclick="window.print()" style="display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="printer" style="width: 16px; height: 16px;"></i> Cetak Struk
                </button>
                <button type="button" class="btn btn-primary" onclick="closeModal('invoice-modal')">Tutup</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // --- 1. Client-Side Tab Switcher Logic ---
        const sidebarLinks = document.querySelectorAll('.admin-sidebar-link');
        const tabPanes = document.querySelectorAll('.tab-pane');

        const switchTab = (tabId) => {
            // Deactivate all links and show target link active
            sidebarLinks.forEach(link => {
                if (link.getAttribute('data-tab') === tabId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Toggle active pane
            tabPanes.forEach(pane => {
                if (pane.getAttribute('id') === `pane-${tabId}`) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });

            // Update browser location hash
            window.location.hash = tabId;
        };

        // Bind sidebar link events
        sidebarLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const tabId = link.getAttribute('data-tab');
                if (tabId) {
                    e.preventDefault();
                    switchTab(tabId);
                }
            });
        });

        // Check query parameters or hashes on load
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tabQuery = urlParams.get('tab');
            const hashQuery = window.location.hash.substring(1);
            
            if (tabQuery) {
                switchTab(tabQuery);
            } else if (hashQuery) {
                switchTab(hashQuery);
            }
        });


        // --- 2. Live Client-Side Table Search Filtering ---
        const searchInputs = document.querySelectorAll('.tab-search-input');
        searchInputs.forEach(input => {
            input.addEventListener('keyup', () => {
                const query = input.value.toLowerCase();
                const targetTableId = input.getAttribute('data-target-table');
                const rows = document.querySelectorAll(`#${targetTableId} tbody tr`);
                
                rows.forEach(row => {
                    const cells = Array.from(row.querySelectorAll('td'));
                    const match = cells.some(cell => cell.innerText.toLowerCase().includes(query));
                    row.style.display = match ? '' : 'none';
                });
            });
        });


        // --- 3. Chart.js Linear Activity Curve (Figma Style) ---
        const activityCtx = document.getElementById('activityChart')?.getContext('2d');
        if (activityCtx) {
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [
                        {
                            label: 'Booking Masuk',
                            data: [5, 12, 10, 18, 14, 25, 8],
                            borderColor: '#5a52e5', // Purple
                            backgroundColor: 'rgba(90, 82, 229, 0.04)',
                            borderWidth: 3,
                            pointBackgroundColor: '#5a52e5',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Servis Selesai',
                            data: [3, 9, 8, 14, 12, 22, 7],
                            borderColor: '#f97316', // Orange
                            backgroundColor: 'rgba(249, 115, 22, 0.04)',
                            borderWidth: 3,
                            pointBackgroundColor: '#f97316',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    family: 'Outfit',
                                    weight: '600'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }


        // --- 4. Interactive Dialog Modals Trigger Handlers ---
        const openModal = (modalId) => {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('open');
            }
        };

        const closeModal = (modalId) => {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('open');
            }
        };

        // --- Booking Update Modal Populator ---
        const editButtons = document.querySelectorAll('.edit-booking-btn');
        const modalBookingId = document.getElementById('modal-booking-id');
        const modalBookingCode = document.getElementById('modal-booking-code');
        const modalBookingName = document.getElementById('modal-booking-name');
        const modalStatus = document.getElementById('modal-status');
        const modalNotes = document.getElementById('modal-notes');
        const modalCost = document.getElementById('modal-cost');

        editButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                modalBookingId.value = btn.getAttribute('data-id');
                modalBookingCode.innerText = btn.getAttribute('data-code');
                modalBookingName.innerText = '(' + btn.getAttribute('data-name') + ')';
                modalStatus.value = btn.getAttribute('data-status');
                modalNotes.value = btn.getAttribute('data-notes');
                modalCost.value = btn.getAttribute('data-cost');
                openModal('edit-modal');
            });
        });

        // --- Booking Full Info Edit Modals ---
        const addBookingBtn = document.getElementById('btn-add-booking');
        const addServisBtn = document.getElementById('btn-add-servis');
        const addTransaksiBtn = document.getElementById('btn-add-transaksi');
        const editBookingInfoButtons = document.querySelectorAll('.edit-booking-info-btn');
        
        const resetBookingForm = () => {
            document.getElementById('booking-modal-title').innerText = 'Tambah Booking Baru';
            document.getElementById('booking-id').value = '';
            document.getElementById('booking-name').value = '';
            document.getElementById('booking-phone').value = '';
            document.getElementById('booking-brand').value = 'Honda';
            document.getElementById('booking-model').value = '';
            document.getElementById('booking-branch').value = '';
            document.getElementById('booking-plate').value = '';
            document.getElementById('booking-type').value = 'Tune Up Rutin';
            document.getElementById('booking-date').value = new Date().toISOString().split('T')[0];
            document.getElementById('booking-time').value = '09:00';
            document.getElementById('booking-complaints').value = '';
        };

        if (addBookingBtn) {
            addBookingBtn.addEventListener('click', () => {
                resetBookingForm();
                document.getElementById('booking-status-hidden').value = 'Diterima';
                openModal('booking-modal');
            });
        }

        if (addServisBtn) {
            addServisBtn.addEventListener('click', () => {
                resetBookingForm();
                document.getElementById('booking-modal-title').innerText = 'Tambah Progres Servis Baru';
                document.getElementById('booking-status-hidden').value = 'Dikerjakan';
                openModal('booking-modal');
            });
        }

        if (addTransaksiBtn) {
            addTransaksiBtn.addEventListener('click', () => {
                resetBookingForm();
                document.getElementById('booking-modal-title').innerText = 'Tambah Transaksi Invoicing Baru';
                document.getElementById('booking-status-hidden').value = 'Sudah Diambil';
                openModal('booking-modal');
            });
        }

        editBookingInfoButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('booking-modal-title').innerText = 'Update Data Booking';
                document.getElementById('booking-id').value = btn.getAttribute('data-id');
                document.getElementById('booking-name').value = btn.getAttribute('data-name');
                document.getElementById('booking-phone').value = btn.getAttribute('data-phone');
                document.getElementById('booking-brand').value = btn.getAttribute('data-brand');
                document.getElementById('booking-model').value = btn.getAttribute('data-model');
                document.getElementById('booking-branch').value = btn.getAttribute('data-branch');
                document.getElementById('booking-plate').value = btn.getAttribute('data-plate');
                document.getElementById('booking-type').value = btn.getAttribute('data-type');
                document.getElementById('booking-date').value = btn.getAttribute('data-date');
                document.getElementById('booking-time').value = btn.getAttribute('data-time');
                document.getElementById('booking-complaints').value = btn.getAttribute('data-complaints');
                openModal('booking-modal');
            });
        });

        // --- Cabang Modal Populator ---
        const addBranchBtn = document.getElementById('btn-add-branch');
        const editBranchButtons = document.querySelectorAll('.edit-branch-btn');
        
        if (addBranchBtn) {
            addBranchBtn.addEventListener('click', () => {
                document.getElementById('branch-modal-title').innerText = 'Tambah Cabang Baru';
                document.getElementById('branch-id').value = '';
                document.getElementById('branch-name').value = '';
                document.getElementById('branch-address').value = '';
                document.getElementById('branch-phone').value = '';
                document.getElementById('branch-pic').value = '';
                document.getElementById('branch-status').value = 'Aktif';
                openModal('branch-modal');
            });
        }

        editBranchButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('branch-modal-title').innerText = 'Update Data Cabang';
                document.getElementById('branch-id').value = btn.getAttribute('data-id');
                document.getElementById('branch-name').value = btn.getAttribute('data-name');
                document.getElementById('branch-address').value = btn.getAttribute('data-address');
                document.getElementById('branch-phone').value = btn.getAttribute('data-phone');
                document.getElementById('branch-pic').value = btn.getAttribute('data-pic');
                document.getElementById('branch-status').value = btn.getAttribute('data-status');
                openModal('branch-modal');
            });
        });

        // --- Mekanik Modal Populator ---
        const addMechanicBtn = document.getElementById('btn-add-mechanic');
        const editMechanicButtons = document.querySelectorAll('.edit-mechanic-btn');

        if (addMechanicBtn) {
            addMechanicBtn.addEventListener('click', () => {
                document.getElementById('mechanic-modal-title').innerText = 'Tambah Mekanik Baru';
                document.getElementById('mechanic-id').value = '';
                document.getElementById('mechanic-name').value = '';
                document.getElementById('mechanic-phone').value = '';
                document.getElementById('mechanic-specialty').value = '';
                document.getElementById('mechanic-branch').value = '';
                document.getElementById('mechanic-status').value = 'Aktif';
                openModal('mechanic-modal');
            });
        }

        editMechanicButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('mechanic-modal-title').innerText = 'Update Data Mekanik';
                document.getElementById('mechanic-id').value = btn.getAttribute('data-id');
                document.getElementById('mechanic-name').value = btn.getAttribute('data-name');
                document.getElementById('mechanic-phone').value = btn.getAttribute('data-phone');
                document.getElementById('mechanic-specialty').value = btn.getAttribute('data-specialty');
                document.getElementById('mechanic-branch').value = btn.getAttribute('data-branch');
                document.getElementById('mechanic-status').value = btn.getAttribute('data-status');
                openModal('mechanic-modal');
            });
        });

        // --- Sparepart Modal Populator ---
        const addSparepartBtn = document.getElementById('btn-add-sparepart');
        const editSparepartButtons = document.querySelectorAll('.edit-sparepart-btn');

        if (addSparepartBtn) {
            addSparepartBtn.addEventListener('click', () => {
                document.getElementById('sparepart-modal-title').innerText = 'Tambah Sparepart Baru';
                document.getElementById('sparepart-id').value = '';
                document.getElementById('sparepart-name').value = '';
                document.getElementById('sparepart-code').value = '';
                document.getElementById('sparepart-category').value = '';
                document.getElementById('sparepart-stock').value = '';
                document.getElementById('sparepart-price').value = '';
                openModal('sparepart-modal');
            });
        }

        editSparepartButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('sparepart-modal-title').innerText = 'Update Data Sparepart';
                document.getElementById('sparepart-id').value = btn.getAttribute('data-id');
                document.getElementById('sparepart-name').value = btn.getAttribute('data-name');
                document.getElementById('sparepart-code').value = btn.getAttribute('data-code');
                document.getElementById('sparepart-category').value = btn.getAttribute('data-category');
                document.getElementById('sparepart-stock').value = btn.getAttribute('data-stock');
                document.getElementById('sparepart-price').value = btn.getAttribute('data-price');
                openModal('sparepart-modal');
            });
        });

        // --- Pelanggan (Customer) Modal Populator ---
        const addCustomerBtn = document.getElementById('btn-add-customer');
        const editCustomerButtons = document.querySelectorAll('.edit-customer-btn');

        if (addCustomerBtn) {
            addCustomerBtn.addEventListener('click', () => {
                document.getElementById('customer-modal-title').innerText = 'Tambah Pelanggan Baru';
                document.getElementById('customer-id').value = '';
                document.getElementById('customer-name').value = '';
                document.getElementById('customer-email').value = '';
                document.getElementById('customer-phone').value = '';
                document.getElementById('customer-address').value = '';
                openModal('customer-modal');
            });
        }

        editCustomerButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('customer-modal-title').innerText = 'Update Data Pelanggan';
                document.getElementById('customer-id').value = btn.getAttribute('data-id');
                document.getElementById('customer-name').value = btn.getAttribute('data-name');
                document.getElementById('customer-email').value = btn.getAttribute('data-email');
                document.getElementById('customer-phone').value = btn.getAttribute('data-phone');
                document.getElementById('customer-address').value = btn.getAttribute('data-address');
                openModal('customer-modal');
            });
        });

        // --- Motor Modal Populator ---
        const addMotorBtn = document.getElementById('btn-add-motor');
        const editMotorButtons = document.querySelectorAll('.edit-motor-btn');

        if (addMotorBtn) {
            addMotorBtn.addEventListener('click', () => {
                document.getElementById('motor-modal-title').innerText = 'Tambah Motor Baru';
                document.getElementById('motor-id').value = '';
                document.getElementById('motor-plate').value = '';
                document.getElementById('motor-brand').value = '';
                document.getElementById('motor-type').value = '';
                document.getElementById('motor-year').value = '';
                document.getElementById('motor-owner').value = '';
                openModal('motor-modal');
            });
        }

        editMotorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('motor-modal-title').innerText = 'Update Data Motor';
                document.getElementById('motor-id').value = btn.getAttribute('data-id');
                document.getElementById('motor-plate').value = btn.getAttribute('data-plate');
                document.getElementById('motor-brand').value = btn.getAttribute('data-brand');
                document.getElementById('motor-type').value = btn.getAttribute('data-type');
                document.getElementById('motor-year').value = btn.getAttribute('data-year');
                document.getElementById('motor-owner').value = btn.getAttribute('data-owner');
                openModal('motor-modal');
            });
        });

        // --- Invoice Modal Populator ---
        const showInvoiceButtons = document.querySelectorAll('.show-invoice-btn');
        showInvoiceButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const code = btn.getAttribute('data-code');
                const name = btn.getAttribute('data-name');
                const date = btn.getAttribute('data-date');
                const phone = btn.getAttribute('data-phone');
                const service = btn.getAttribute('data-service');
                const cost = parseInt(btn.getAttribute('data-cost')) || 0;
                const status = btn.getAttribute('data-status');
                const complaints = btn.getAttribute('data-complaints');

                document.getElementById('invoice-modal-title').innerText = 'Detail Transaksi #' + code;
                document.getElementById('invoice-date').innerText = date;
                document.getElementById('invoice-name').innerText = name;
                document.getElementById('invoice-phone').innerText = phone;
                
                const statusSpan = document.getElementById('invoice-status');
                if (status === 'Sudah Diambil' || status === 'Selesai') {
                    statusSpan.innerText = 'Sukses';
                    statusSpan.style.color = '#22c55e';
                } else {
                    statusSpan.innerText = status;
                    statusSpan.style.color = '#eab308'; // yellow/pending
                }

                document.getElementById('invoice-item-name').innerText = service;
                
                const formattedPrice = cost.toLocaleString('id-ID');
                document.getElementById('invoice-item-price').innerText = formattedPrice;
                document.getElementById('invoice-item-subtotal').innerText = formattedPrice;
                document.getElementById('invoice-summary-subtotal').innerText = formattedPrice;
                document.getElementById('invoice-summary-total').innerText = formattedPrice;
                document.getElementById('invoice-note').innerText = complaints;
                
                openModal('invoice-modal');
            });
        });
    </script>
@endsection
