@extends('layouts.app')

@section('title', 'Dashboard Saya - Turbo Garage')
@section('meta_description', 'Pantau status antrean dan riwayat servis motor Anda secara langsung di Turbo Garage.')

@section('styles')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        align-items: start;
    }
    
    @media (min-width: 992px) {
        .dashboard-grid {
            grid-template-columns: 1.6fr 1.4fr;
        }
    }
    
    .motor-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-sm);
        margin-bottom: 12px;
        transition: all var(--transition-fast);
    }
    
    [data-theme="dark"] .motor-item {
        background-color: var(--bg-tertiary);
        border-color: var(--border-color);
    }
    
    .motor-item:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    
    .motor-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .motor-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: var(--accent-light);
        color: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .motor-details h4 {
        font-family: var(--font-heading);
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 4px 0;
    }
    
    .motor-details p {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin: 0;
    }
    
    .motor-actions {
        display: flex;
        gap: 8px;
    }
    
    .btn-action-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        cursor: pointer;
        transition: all var(--transition-fast);
    }
    
    .btn-action-icon:hover {
        color: var(--accent);
        background-color: var(--accent-light);
        border-color: var(--accent);
    }
    
    .btn-action-icon.delete:hover {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.15);
        border-color: #ef4444;
    }
    
    /* Modal styles */
    .garage-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    
    .garage-modal-box {
        background: white;
        max-width: 480px;
        width: 90%;
        padding: 30px;
        border-radius: var(--radius-md);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        position: relative;
        text-align: left;
    }
    
    [data-theme="dark"] .garage-modal-box {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 8px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        background-color: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        font-size: 0.95rem;
        color: var(--text-primary);
        transition: border-color var(--transition-fast);
    }
    
    .form-control:focus {
        border-color: var(--accent);
    }
</style>
@endsection

@section('content')
<main class="section" style="padding-top: 140px; padding-bottom: 80px; min-height: 80vh; background-color: #f8fafc;">
    <div class="container" style="max-width: 1000px;">
        
        <!-- Welcome Banner -->
        <div style="background: linear-gradient(135deg, #4c46bb 0%, #312e81 100%); color: white; border-radius: var(--radius-md); padding: 40px; margin-bottom: 40px; box-shadow: 0 10px 25px rgba(76, 70, 187, 0.15); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 24px;">
            <div>
                <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #a5f3fc; display: block; margin-bottom: 8px;">DASHBOARD PELANGGAN</span>
                <h1 style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; margin: 0; line-height: 1.1;">Halo, {{ auth()->user()->username }}!</h1>
                <p style="margin: 12px 0 0 0; color: rgba(255, 255, 255, 0.85); font-size: 1rem;">Selamat datang kembali. Di sini Anda dapat memantau status pengerjaan motor Anda secara real-time.</p>
            </div>
            <div>
                <a href="{{ route('booking.index') }}" class="btn" style="background-color: #ffffff; color: #4c46bb; font-family: var(--font-heading); font-weight: 800; padding: 14px 28px; border-radius: var(--radius-sm); font-size: 0.95rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all var(--transition-fast);">
                    <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i> Booking Servis Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background-color: rgba(34, 197, 94, 0.15); color: #22c55e; padding: 14px 20px; border-radius: var(--radius-sm); border: 1px solid rgba(34, 197, 94, 0.2); margin-bottom: 30px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;">
                <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="dashboard-grid">
            <!-- Riwayat Servis -->
            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); height: fit-content; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 16px;">
                    <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="history" style="color: #4c46bb; width: 22px; height: 22px;"></i> Riwayat Servis Motor Anda
                    </h3>
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Total: {{ $bookings->count() }} Transaksi</span>
                </div>

                @if($bookings->isEmpty())
                    <div style="text-align: center; padding: 50px 20px;">
                        <div style="color: #cbd5e1; margin-bottom: 20px;">
                            <i data-lucide="clipboard-list" style="width: 64px; height: 64px;"></i>
                        </div>
                        <h4 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 700; color: #64748b; margin-bottom: 8px;">Belum Ada Riwayat Servis</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem; max-width: 400px; margin: 0 auto 24px auto;">Anda belum pernah melakukan pemesanan servis motor menggunakan akun ini.</p>
                        <a href="{{ route('booking.index') }}" class="btn" style="background-color: #4c46bb; color: white; padding: 12px 24px; font-weight: 700; text-decoration: none; border-radius: var(--radius-sm); font-size: 0.9rem;">
                            Booking Servis Sekarang
                        </a>
                    </div>
                @else
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b; font-weight: 700;">
                                    <th style="padding: 12px 16px;">Kode</th>
                                    <th style="padding: 12px 16px;">Motor</th>
                                    <th style="padding: 12px 16px;">Layanan</th>
                                    <th style="padding: 12px 16px;">Jadwal</th>
                                    <th style="padding: 12px 16px; text-align: center;">Status</th>
                                    <th style="padding: 12px 16px; text-align: right;">Total Biaya</th>
                                    <th style="padding: 12px 16px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $b)
                                    @php
                                        // Status badge colors
                                        $statusClass = '';
                                        switch($b->status) {
                                            case 'Diterima':
                                                $statusStyle = 'background-color: #e0f2fe; color: #0369a1;';
                                                break;
                                            case 'Antrean':
                                                $statusStyle = 'background-color: #fef3c7; color: #b45309;';
                                                break;
                                            case 'Dikerjakan':
                                                $statusStyle = 'background-color: #dbeafe; color: #1d4ed8;';
                                                break;
                                            case 'Selesai':
                                                $statusStyle = 'background-color: #dcfce7; color: #15803d;';
                                                break;
                                            case 'Sudah Diambil':
                                                $statusStyle = 'background-color: #f1f5f9; color: #475569;';
                                                break;
                                            default:
                                                $statusStyle = 'background-color: #e2e8f0; color: #475569;';
                                        }
                                    @endphp
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background-color var(--transition-fast);" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                        <td style="padding: 16px 16px; font-weight: 700; color: #4c46bb;">{{ $b->booking_code }}</td>
                                        <td style="padding: 16px 16px;">
                                            <span style="font-weight: 600; color: #1e293b; display: block;">{{ $b->motor_brand }} {{ $b->motor_model }}</span>
                                            <span style="font-size: 0.8rem; color: #64748b;">{{ $b->license_plate }}</span>
                                        </td>
                                        <td style="padding: 16px 16px; font-weight: 600; color: #334155;">{{ $b->service_type }}</td>
                                        <td style="padding: 16px 16px;">
                                            <span style="display:block; font-weight: 600; color: #334155;">{{ $b->service_date }}</span>
                                            <span style="font-size: 0.8rem; color: #64748b;">{{ $b->service_time }} WIB</span>
                                        </td>
                                        <td style="padding: 16px 16px; text-align: center;">
                                            <span style="font-size: 0.8rem; font-weight: 700; padding: 6px 12px; border-radius: var(--radius-full); display: inline-block; {{ $statusStyle }}">
                                                {{ $b->status }}
                                            </span>
                                        </td>
                                        <td style="padding: 16px 16px; text-align: right; font-weight: 700; color: #1e293b;">
                                            {{ $b->total_cost > 0 ? $b->formatted_cost : 'Menunggu pengerjaan' }}
                                        </td>
                                        <td style="padding: 16px 16px; text-align: center;">
                                            <button onclick="showInvoice({{ json_encode($b) }})" class="btn" style="background-color: var(--bg-tertiary); color: #4c46bb; padding: 6px 14px; border-radius: var(--radius-sm); font-size: 0.85rem; font-weight: 700; border: none; cursor: pointer; transition: all var(--transition-fast);">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Garasi Motor Saya -->
            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: var(--radius-md); padding: 30px; box-shadow: var(--card-shadow); height: fit-content;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 16px;">
                    <h3 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 800; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="shield" style="color: #4c46bb; width: 22px; height: 22px;"></i> Garasi Motor Saya
                    </h3>
                    <button onclick="openGarageModal()" class="btn" style="background-color: var(--accent); color: white; padding: 8px 16px; border-radius: var(--radius-sm); font-size: 0.85rem; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all var(--transition-fast);">
                        <i data-lucide="plus" style="width: 16px; height: 16px;"></i> Tambah
                    </button>
                </div>

                <div id="garage-list-container">
                    <!-- Dynamic garage list will be rendered here via JS -->
                </div>
            </div>
        </div>

    </div>
</main>

<!-- ==================== MODAL: ADD/EDIT MOTOR GARAGE ==================== -->
<div class="garage-modal-overlay" id="garage-motor-modal" style="display: none;">
    <div class="garage-modal-box">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; margin-bottom: 24px;">
            <h3 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0;" id="garage-modal-title">Tambah Motor ke Garasi</h3>
            <div onclick="closeGarageModal()" style="background-color: var(--bg-tertiary); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <i data-lucide="x" style="width: 16px; height: 16px; color: #64748b;"></i>
            </div>
        </div>
        
        <form id="garage-motor-form" onsubmit="saveGarageMotor(event)">
            <input type="hidden" id="garage-motor-index" value="-1">
            
            <div class="form-group">
                <label for="garage-motor-brand">Merek Motor *</label>
                <select id="garage-motor-brand" class="form-control" required style="width:100%; border:1px solid var(--border-color); background-color: var(--bg-tertiary); color: var(--text-primary); border-radius: var(--radius-sm); padding:12px 16px;">
                    <option value="" disabled selected>Pilih Merek</option>
                    <option value="Honda">Honda</option>
                    <option value="Yamaha">Yamaha</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Kawasaki">Kawasaki</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="garage-motor-model">Model / Tipe Motor *</label>
                <input type="text" id="garage-motor-model" class="form-control" placeholder="Contoh: Vario 150, NMAX, Beat" required style="width:100%; border:1px solid var(--border-color); background-color: var(--bg-tertiary); color: var(--text-primary); border-radius: var(--radius-sm); padding:12px 16px;">
            </div>
            
            <div class="form-group">
                <label for="garage-motor-plate">Nomor Polisi (Plat Motor) *</label>
                <input type="text" id="garage-motor-plate" class="form-control" placeholder="Contoh: B 1234 ABC" required style="width:100%; border:1px solid var(--border-color); background-color: var(--bg-tertiary); color: var(--text-primary); border-radius: var(--radius-sm); padding:12px 16px;">
            </div>
            
            <div class="form-group">
                <label for="garage-motor-year">Tahun Pembuatan (Opsional)</label>
                <input type="number" id="garage-motor-year" class="form-control" placeholder="Contoh: 2020" min="1900" max="2099" style="width:100%; border:1px solid var(--border-color); background-color: var(--bg-tertiary); color: var(--text-primary); border-radius: var(--radius-sm); padding:12px 16px;">
            </div>
            
            <div style="display: flex; gap: 16px; justify-content: flex-end; margin-top: 30px;">
                <button type="button" class="btn btn-secondary" onclick="closeGarageModal()" style="border: 1px solid var(--border-color); background: transparent; font-weight: 700; padding: 10px 20px; border-radius: var(--radius-sm); cursor: pointer; color: var(--text-secondary);">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #4c46bb; color: white; border: none; font-weight: 700; padding: 10px 24px; border-radius: var(--radius-sm); cursor: pointer;">Simpan Motor</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL: DETAIL INVOICE TRANSAKSI ==================== -->
<div class="modal-overlay" id="user-invoice-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center;">
    <div class="modal-box" style="background: white; max-width: 600px; width: 90%; padding: 30px; border-radius: var(--radius-md); box-shadow: 0 20px 50px rgba(0,0,0,0.15); position: relative; margin: 20px auto; text-align: left;">
        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: none; padding-bottom: 0; margin-bottom: 20px;">
            <h3 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0;" id="invoice-modal-title">Detail Struk Transaksi</h3>
            <div class="modal-close" onclick="closeInvoiceModal()" style="background-color: var(--bg-tertiary); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <i data-lucide="x" style="width: 16px; height: 16px; color: #64748b;"></i>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; text-align: left; font-size: 0.9rem;">
            <div>
                <div style="margin-bottom: 12px;">
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Kode Booking</span>
                    <span id="invoice-code" style="font-weight: 700; color: #4c46bb;">SVM-1001</span>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Tanggal Booking</span>
                    <span id="invoice-date" style="font-weight: 700; color: var(--text-primary);">2026-06-11</span>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Jadwal Jam</span>
                    <span id="invoice-time" style="font-weight: 700; color: var(--text-primary);">09:00 WIB</span>
                </div>
            </div>
            <div>
                <div style="margin-bottom: 12px;">
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Sepeda Motor</span>
                    <span id="invoice-motor" style="font-weight: 700; color: var(--text-primary);">Honda Vario 150</span>
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Nomor Polisi</span>
                    <span id="invoice-plate" style="font-weight: 700; color: var(--text-primary);">B 1234 XYZ</span>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-weight: 600; display: block; font-size: 0.75rem; text-transform: uppercase;">Cabang Lokasi</span>
                    <span id="invoice-branch" style="font-weight: 700; color: var(--text-primary);">Cabang Depok</span>
                </div>
            </div>
        </div>

        <div style="border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); padding: 16px 0; margin-bottom: 24px;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-secondary); font-weight: 700;">
                        <th style="padding-bottom: 10px;">Item Deskripsi</th>
                        <th style="text-align: right; padding-bottom: 10px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 12px 0; font-weight: 600; color: var(--text-primary);" id="invoice-item-name">Servis Rutin</td>
                        <td style="text-align: right; padding: 12px 0; font-weight: 700; color: var(--text-primary);" id="invoice-item-cost">Rp 50.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); font-weight: 700; display: block;">Catatan Mekanik / Keluhan</span>
                <p id="invoice-notes" style="font-size: 0.85rem; color: var(--text-primary); margin: 4px 0 0 0; font-style: italic;">"Rem belakang telah disetel ulang, oli diganti baru."</p>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">Total Bayar</span>
                <span id="invoice-total" style="font-size: 1.6rem; font-weight: 800; color: #4c46bb; display: block; line-height: 1.1;">Rp 50.000</span>
            </div>
        </div>

        <div style="display: flex; gap: 16px; justify-content: flex-end;">
            <button type="button" class="btn btn-secondary" onclick="closeInvoiceModal()" style="border: 1px solid var(--border-color); background: transparent; font-weight: 700; padding: 10px 20px; border-radius: var(--radius-sm); cursor: pointer; color: var(--text-secondary);">Tutup</button>
            <button type="button" onclick="window.print()" class="btn btn-primary" style="background: #4c46bb; color: white; border: none; font-weight: 700; padding: 10px 24px; border-radius: var(--radius-sm); cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="printer" style="width: 16px; height: 16px;"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>

<script>
    function showInvoice(booking) {
        document.getElementById('invoice-code').innerText = booking.booking_code;
        document.getElementById('invoice-date').innerText = booking.service_date;
        document.getElementById('invoice-time').innerText = booking.service_time + ' WIB';
        document.getElementById('invoice-motor').innerText = booking.motor_brand + ' ' + booking.motor_model;
        document.getElementById('invoice-plate').innerText = booking.license_plate;
        document.getElementById('invoice-branch').innerText = booking.branch || 'Cabang Utama Jakarta';
        
        document.getElementById('invoice-item-name').innerText = booking.service_type;
        
        const price = booking.total_cost > 0 ? booking.total_cost : 0;
        const formattedPrice = 'Rp ' + price.toLocaleString('id-ID');
        document.getElementById('invoice-item-cost').innerText = formattedPrice;
        document.getElementById('invoice-total').innerText = formattedPrice;
        
        document.getElementById('invoice-notes').innerText = booking.mechanic_notes || booking.complaints || '-';
        
        const modal = document.getElementById('user-invoice-modal');
        modal.style.display = 'flex';
        
        lucide.createIcons();
    }

    function closeInvoiceModal() {
        document.getElementById('user-invoice-modal').style.display = 'none';
    }

    // Scoped storage key using the authenticated user's name
    const currentUser = "{{ auth()->user()->username }}";
    const storageKey = `garage_user_${currentUser}`;
    
    // Load motors from local storage
    let myGarage = [];
    try {
        const stored = localStorage.getItem(storageKey);
        if (stored) {
            myGarage = JSON.parse(stored);
        }
    } catch(e) {
        console.error("Gagal membaca data garasi", e);
    }
    
    // If no motors, set a default motor for demonstration
    if (myGarage.length === 0) {
        myGarage = [
            { brand: 'Honda', model: 'Vario 150', plate: 'B 3012 SHG', year: '2019' }
        ];
        localStorage.setItem(storageKey, JSON.stringify(myGarage));
    }

    function renderGarage() {
        const container = document.getElementById('garage-list-container');
        if (!container) return;
        
        if (myGarage.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 40px 20px;">
                    <div style="color: #cbd5e1; margin-bottom: 16px;">
                        <i data-lucide="shield-alert" style="width: 48px; height: 48px; margin: 0 auto;"></i>
                    </div>
                    <h4 style="font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; color: #64748b; margin-bottom: 6px;">Garasi Masih Kosong</h4>
                    <p style="color: #94a3b8; font-size: 0.9rem; max-width: 280px; margin: 0 auto;">Simpan motor Anda di sini agar tidak perlu mengetik detail motor saat melakukan booking!</p>
                </div>
            `;
            lucide.createIcons();
            return;
        }
        
        let html = '';
        myGarage.forEach((motor, index) => {
            let brandColor = 'var(--accent)';
            if (motor.brand === 'Honda') brandColor = '#ef4444';
            else if (motor.brand === 'Yamaha') brandColor = '#3b82f6';
            else if (motor.brand === 'Suzuki') brandColor = '#f59e0b';
            else if (motor.brand === 'Kawasaki') brandColor = '#10b981';
            
            html += `
                <div class="motor-item">
                    <div class="motor-info">
                        <div class="motor-icon" style="background-color: rgba(90, 82, 229, 0.08); color: ${brandColor};">
                            <i data-lucide="shield" style="width: 20px; height: 20px;"></i>
                        </div>
                        <div class="motor-details">
                            <h4 style="color: var(--text-primary);">${motor.brand} ${motor.model}</h4>
                            <p>${motor.plate} ${motor.year ? `• Th ${motor.year}` : ''}</p>
                        </div>
                    </div>
                    <div class="motor-actions">
                        <button onclick="editGarageMotor(${index})" class="btn-action-icon" title="Edit Motor">
                            <i data-lucide="edit" style="width: 14px; height: 14px;"></i>
                        </button>
                        <button onclick="deleteGarageMotor(${index})" class="btn-action-icon delete" title="Hapus Motor">
                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        lucide.createIcons();
    }
    
    function openGarageModal(isEdit = false, index = -1) {
        const modal = document.getElementById('garage-motor-modal');
        const title = document.getElementById('garage-modal-title');
        const formIndex = document.getElementById('garage-motor-index');
        
        const formBrand = document.getElementById('garage-motor-brand');
        const formModel = document.getElementById('garage-motor-model');
        const formPlate = document.getElementById('garage-motor-plate');
        const formYear = document.getElementById('garage-motor-year');
        
        if (isEdit && index >= 0) {
            title.innerText = 'Edit Detail Motor';
            formIndex.value = index;
            const motor = myGarage[index];
            formBrand.value = motor.brand;
            formModel.value = motor.model;
            formPlate.value = motor.plate;
            formYear.value = motor.year || '';
        } else {
            title.innerText = 'Tambah Motor Baru';
            formIndex.value = -1;
            document.getElementById('garage-motor-form').reset();
        }
        
        modal.style.display = 'flex';
    }
    
    // Close modal function (covers clicking Batal or overlay close)
    window.closeGarageModal = function() {
        document.getElementById('garage-motor-modal').style.display = 'none';
    }
    
    function saveGarageMotor(e) {
        e.preventDefault();
        
        const index = parseInt(document.getElementById('garage-motor-index').value);
        const brand = document.getElementById('garage-motor-brand').value;
        const model = document.getElementById('garage-motor-model').value.trim();
        const plate = document.getElementById('garage-motor-plate').value.trim().toUpperCase();
        const year = document.getElementById('garage-motor-year').value.trim();
        
        if (!brand || !model || !plate) {
            alert('Harap lengkapi semua kolom wajib.');
            return;
        }
        
        const motorData = { brand, model, plate, year };
        
        if (index >= 0) {
            myGarage[index] = motorData;
        } else {
            myGarage.push(motorData);
        }
        
        localStorage.setItem(storageKey, JSON.stringify(myGarage));
        closeGarageModal();
        renderGarage();
    }
    
    function editGarageMotor(index) {
        openGarageModal(true, index);
    }
    
    function deleteGarageMotor(index) {
        const motor = myGarage[index];
        if (confirm(`Apakah Anda yakin ingin menghapus ${motor.brand} ${motor.model} (${motor.plate}) dari garasi Anda?`)) {
            myGarage.splice(index, 1);
            localStorage.setItem(storageKey, JSON.stringify(myGarage));
            renderGarage();
        }
    }
    
    // Initial run
    document.addEventListener('DOMContentLoaded', () => {
        renderGarage();
    });
</script>
@endsection
