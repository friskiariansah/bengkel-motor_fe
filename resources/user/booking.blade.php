@extends('layouts.app')

@section('title', 'Booking Servis Motor - Jadwalkan Perawatan Motor Anda')
@section('meta_description', 'Booking jadwal servis motor Anda secara online. Cepat, mudah, dan bebas antre.')

@section('content')
    <!-- Main Section -->
    <main class="section" style="padding-top: 140px; min-height: 80vh;">
        <div class="container">
            <div class="section-title-wrapper" style="margin-bottom: 20px;">
                <span class="section-tag">Booking Online</span>
                <h2 class="section-title">Formulir Booking Servis</h2>
                <p class="section-desc">Isi data di bawah ini untuk memesan slot antrean servis Anda. Kami akan menyiapkan mekanik terbaik untuk Anda.</p>
            </div>

            @if(isset($success) && $success && isset($booking_details))
                <!-- Success State Ticket View -->
                <div class="form-box" style="max-width: 600px;">
                    <div class="success-card">
                        <div class="success-icon">
                            <i data-lucide="check-circle" style="width: 48px; height: 48px;"></i>
                        </div>
                        <h3 class="success-title">Booking Berhasil!</h3>
                        <p>Simpan kode booking Anda untuk melakukan pelacakan status servis motor Anda. Klik pada kode untuk menyalin.</p>
                        
                        <div class="success-code-box">
                            {{ $booking_details->booking_code }}
                        </div>
                        
                        <div class="tracking-summary-card" style="text-align: left; background-color: var(--bg-tertiary); box-shadow: none; padding: 20px; border-radius: var(--radius-md);">
                            <div class="summary-grid">
                                <div class="summary-item">
                                    <label>Nama Pemilik</label>
                                    <p>{{ $booking_details->name }}</p>
                                </div>
                                <div class="summary-item">
                                    <label>Nomor WhatsApp</label>
                                    <p>{{ $booking_details->phone }}</p>
                                </div>
                                <div class="summary-item">
                                    <label>Sepeda Motor</label>
                                    <p>{{ $booking_details->motor_brand }} {{ $booking_details->motor_model }}</p>
                                </div>
                                <div class="summary-item">
                                    <label>Nomor Polisi</label>
                                    <p>{{ $booking_details->license_plate }}</p>
                                </div>
                                <div class="summary-item">
                                    <label>Jenis Servis</label>
                                    <p>{{ $booking_details->service_type }}</p>
                                </div>
                                <div class="summary-item">
                                    <label>Jadwal Servis</label>
                                    <p>{{ $booking_details->service_date }} @ {{ $booking_details->service_time }} WIB</p>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; justify-content: center; margin-top: 24px;">
                            <a href="{{ route('track.index', ['code' => $booking_details->booking_code]) }}" class="btn btn-primary">
                                <i data-lucide="activity"></i> Lacak Sekarang
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <!-- Booking Form View -->
                <div class="form-box" style="max-width: 750px;">
                    <!-- Step Progress Indicator -->
                    <div class="step-progress-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; position: relative;">
                        <!-- Stepper Line -->
                        <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background-color: var(--border-color); z-index: 1;"></div>
                        <div id="step-progress-line" style="position: absolute; top: 20px; left: 0; width: 0%; height: 3px; background-color: var(--accent); z-index: 2; transition: width var(--transition-normal);"></div>
                        
                        <!-- Step 1 -->
                        <div class="step-indicator active" data-step="1" style="display: flex; flex-direction: column; align-items: center; z-index: 3; position: relative;">
                            <div class="step-number" style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 3px solid var(--bg-secondary); transition: all var(--transition-fast);">1</div>
                            <span class="step-label" style="font-size: 0.8rem; font-weight: 700; margin-top: 8px; color: var(--text-primary);">Pilih Layanan</span>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="step-indicator" data-step="2" style="display: flex; flex-direction: column; align-items: center; z-index: 3; position: relative;">
                            <div class="step-number" style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--bg-tertiary); color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 700; border: 3px solid var(--bg-secondary); transition: all var(--transition-fast);">2</div>
                            <span class="step-label" style="font-size: 0.8rem; font-weight: 500; margin-top: 8px; color: var(--text-secondary);">Pilih Slot</span>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="step-indicator" data-step="3" style="display: flex; flex-direction: column; align-items: center; z-index: 3; position: relative;">
                            <div class="step-number" style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--bg-tertiary); color: var(--text-secondary); display: flex; align-items: center; justify-content: center; font-weight: 700; border: 3px solid var(--bg-secondary); transition: all var(--transition-fast);">3</div>
                            <span class="step-label" style="font-size: 0.8rem; font-weight: 500; margin-top: 8px; color: var(--text-secondary);">Konfirmasi & Selesai</span>
                        </div>
                    </div>

                    @if($errors->any())
                        <div style="background-color: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid rgba(239, 68, 68, 0.2); margin-bottom: 24px; font-weight: 600; font-size: 0.9rem;">
                            <i data-lucide="alert-triangle" style="width:16px; height:16px; display:inline-block; vertical-align:middle; margin-right:6px;"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                        @csrf
                        
                        <!-- STEP 1: PILIH LAYANAN (Frame 15) -->
                        <div class="step-panel" id="panel-step-1">
                            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; border-left: 4px solid var(--accent); padding-left: 10px;">Pilih Layanan</h3>
                            
                            <div class="form-group">
                                <label for="branch">Pilih Cabang *</label>
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="" disabled selected>Pilih Cabang</option>
                                    @forelse($branches ?? [] as $b)
                                        <option value="{{ $b->name }}" {{ old('branch') === $b->name ? 'selected' : '' }}>{{ $b->name }} ({{ $b->address }})</option>
                                    @empty
                                        <option value="Cabang Utama Jakarta" selected>Cabang Utama Jakarta (Jl. Raya Otomotif No. 123)</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="service_type">Pilih Kategori *</label>
                                <select name="service_type" id="service_type" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Tune Up Rutin" {{ (request('service') === 'Tune Up Rutin' || old('service_type') === 'Tune Up Rutin') ? 'selected' : '' }}>Tune Up Rutin</option>
                                    <option value="Ganti Oli & Cairan" {{ (request('service') === 'Ganti Oli & Cairan' || old('service_type') === 'Ganti Oli & Cairan') ? 'selected' : '' }}>Ganti Oli & Cairan</option>
                                    <option value="Servis Rem & Kaki" {{ (request('service') === 'Servis Rem & Kaki' || old('service_type') === 'Servis Rem & Kaki') ? 'selected' : '' }}>Servis Rem & Kaki</option>
                                    <option value="Sistem Kelistrikan" {{ (request('service') === 'Sistem Kelistrikan' || old('service_type') === 'Sistem Kelistrikan') ? 'selected' : '' }}>Sistem Kelistrikan</option>
                                    <option value="Turun Mesin (Overhaul)" {{ (request('service') === 'Turun Mesin (Overhaul)' || old('service_type') === 'Turun Mesin (Overhaul)') ? 'selected' : '' }}>Turun Mesin (Overhaul)</option>
                                    <option value="Paket Servis Lengkap" {{ (request('service') === 'Paket Servis Lengkap' || old('service_type') === 'Paket Servis Lengkap') ? 'selected' : '' }}>Paket Servis Lengkap</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mechanic">Pilih Mekanik *</label>
                                <select name="mechanic" id="mechanic" class="form-control" required>
                                    <option value="" disabled selected>Pilih Mekanik</option>
                                    @forelse($mechanics ?? [] as $m)
                                        <option value="{{ $m->name }}" {{ old('mechanic') === $m->name ? 'selected' : '' }}>{{ $m->name }} (Spesialis: {{ $m->specialty }})</option>
                                    @empty
                                        <option value="Andi Pratama">Andi Pratama (Spesialis: Tune Up)</option>
                                        <option value="Budi Santoso">Budi Santoso (Spesialis: Kelistrikan)</option>
                                    @endforelse
                                </select>
                            </div>
                            
                            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                                <button type="button" class="btn btn-primary" onclick="goToStep(2)">Lanjut <i data-lucide="arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- STEP 2: PILIH SLOT & ISI DETAIL (Frame 16) -->
                        <div class="step-panel" id="panel-step-2" style="display: none;">
                            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; border-left: 4px solid var(--accent); padding-left: 10px;">Pilih Slot & Isi Detail</h3>
                            
                            <div class="form-group-row">
                                <div class="form-group">
                                    <label for="service_date">Pilih Tanggal *</label>
                                    <input type="date" name="service_date" id="service_date" class="form-control" required min="{{ date('Y-m-d') }}" value="{{ old('service_date') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="service_time">Pilih Jam *</label>
                                    <select name="service_time" id="service_time" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jam</option>
                                        <option value="08:00" {{ old('service_time') === '08:00' ? 'selected' : '' }}>08:00 WIB</option>
                                        <option value="09:00" {{ old('service_time') === '09:00' ? 'selected' : '' }}>09:00 WIB</option>
                                        <option value="10:00" {{ old('service_time') === '10:00' ? 'selected' : '' }}>10:00 WIB</option>
                                        <option value="11:00" {{ old('service_time') === '11:00' ? 'selected' : '' }}>11:00 WIB</option>
                                        <option value="13:00" {{ old('service_time') === '13:00' ? 'selected' : '' }}>13:00 WIB</option>
                                        <option value="14:00" {{ old('service_time') === '14:00' ? 'selected' : '' }}>14:00 WIB</option>
                                        <option value="15:00" {{ old('service_time') === '15:00' ? 'selected' : '' }}>15:00 WIB</option>
                                        <option value="16:00" {{ old('service_time') === '16:00' ? 'selected' : '' }}>16:00 WIB</option>
                                    </select>
                                </div>
                            </div>

                            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 24px 0;">
                            
                            <div class="form-group-row">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap *</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Budi Santoso" required value="{{ old('name') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Nomor WhatsApp *</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Contoh: 081234567890" required value="{{ old('phone') }}">
                                </div>
                            </div>
                            
                            <div class="form-group-row">
                                <div class="form-group">
                                    <label for="motor_brand">Merek Motor *</label>
                                    <select name="motor_brand" id="motor_brand" class="form-control" required>
                                        <option value="" disabled selected>Pilih Merek</option>
                                        <option value="Honda" {{ old('motor_brand') === 'Honda' ? 'selected' : '' }}>Honda</option>
                                        <option value="Yamaha" {{ old('motor_brand') === 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                                        <option value="Suzuki" {{ old('motor_brand') === 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                        <option value="Kawasaki" {{ old('motor_brand') === 'Kawasaki' ? 'selected' : '' }}>Kawasaki</option>
                                        <option value="Lainnya" {{ old('motor_brand') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="motor_model">Model / Tipe Motor *</label>
                                    <input type="text" name="motor_model" id="motor_model" class="form-control" placeholder="Contoh: Vario 150, NMAX, Beat" required value="{{ old('motor_model') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="license_plate">Nomor Polisi (Plat Motor) *</label>
                                <input type="text" name="license_plate" id="license_plate" class="form-control" placeholder="Contoh: B 1234 ABC" required value="{{ old('license_plate') }}">
                            </div>

                            <div class="form-group">
                                <label for="complaints">Keluhan / Catatan Tambahan (Opsional)</label>
                                <textarea name="complaints" id="complaints" class="form-control" placeholder="Contoh: Rem belakang agak berdecit, tarikan bawah brebet...">{{ old('complaints') }}</textarea>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; margin-top: 30px; gap: 16px;">
                                <button type="button" class="btn btn-secondary" onclick="goToStep(1)"><i data-lucide="arrow-left"></i> Kembali</button>
                                <button type="button" class="btn btn-primary" onclick="goToStep(3)">Lanjut <i data-lucide="arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- STEP 3: KONFIRMASI & SELESAI (Frame 17) -->
                        <div class="step-panel" id="panel-step-3" style="display: none;">
                            <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; border-left: 4px solid var(--accent); padding-left: 10px;">Konfirmasi & Selesai</h3>
                            
                            <div class="confirm-grid-wrapper" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; margin-bottom: 30px; text-align: left;">
                                <!-- Left side details -->
                                <div class="confirm-card-left" style="background-color: var(--bg-tertiary); padding: 24px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                                    <h4 style="font-family: var(--font-heading); font-weight: 700; color: #1e293b; margin-bottom: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">Detail Booking</h4>
                                    
                                    <div style="display: flex; flex-direction: column; gap: 12px;">
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Cabang</span>
                                            <p id="confirm-branch" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Kategori</span>
                                            <p id="confirm-service" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Mekanik</span>
                                            <p id="confirm-mechanic" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <hr style="border:0; border-top: 1px solid var(--border-color); margin: 8px 0;">
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Nama Lengkap</span>
                                            <p id="confirm-name" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">No WhatsApp</span>
                                            <p id="confirm-phone" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Sepeda Motor</span>
                                            <p id="confirm-motor" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Nomor Polisi</span>
                                            <p id="confirm-plate" style="font-weight: 600; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                        <div>
                                            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-secondary); font-weight: 700;">Keluhan</span>
                                            <p id="confirm-complaints" style="font-size: 0.9rem; font-style: italic; color: var(--text-primary); margin: 2px 0 0 0;"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right side schedule & billing -->
                                <div class="confirm-card-right" style="display: flex; flex-direction: column; gap: 20px;">
                                    <div style="background-color: var(--bg-tertiary); padding: 24px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                                        <h4 style="font-family: var(--font-heading); font-weight: 700; color: #1e293b; margin-bottom: 12px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">Waktu & Jadwal</h4>
                                        <p id="confirm-schedule" style="font-size: 1rem; font-weight: 700; color: var(--accent); margin: 0;"></p>
                                    </div>

                                    <div style="background-color: var(--bg-tertiary); padding: 24px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                                        <h4 style="font-family: var(--font-heading); font-weight: 700; color: #1e293b; margin-bottom: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">Ringkasan Pembayaran</h4>
                                        <div style="display: flex; flex-direction: column; gap: 10px;">
                                            <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                                                <span id="billing-service-name" style="color: var(--text-secondary);">Servis</span>
                                                <span id="billing-subtotal" style="font-weight: 600; color: var(--text-primary);">Rp 0</span>
                                            </div>
                                            <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                                                <span style="color: var(--text-secondary);">Diskon</span>
                                                <span style="font-weight: 600; color: #22c55e;">Rp 0</span>
                                            </div>
                                            <hr style="border:0; border-top: 1px solid var(--border-color); margin: 4px 0;">
                                            <div style="display: flex; justify-content: space-between; font-size: 1.1rem; font-weight: 800;">
                                                <span style="color: var(--text-primary);">Total</span>
                                                <span id="billing-total" style="color: var(--accent);">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; gap: 16px;">
                                <button type="button" class="btn btn-secondary" onclick="goToStep(2)"><i data-lucide="arrow-left"></i> Kembali</button>
                                <button type="submit" class="btn btn-primary" style="flex-grow: 1;">Konfirmasi Booking <i data-lucide="send"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </main>
@endsection

@section('scripts')
<script>
    // Price map for categories
    const categoryPrices = {
        "Tune Up Rutin": 60000,
        "Ganti Oli & Cairan": 45000,
        "Servis Rem & Kaki": 50000,
        "Sistem Kelistrikan": 40000,
        "Turun Mesin (Overhaul)": 150000,
        "Paket Servis Lengkap": 20000
    };

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    function goToStep(stepNumber) {
        // Validation for Step 1
        if (stepNumber === 2) {
            const branch = document.getElementById('branch');
            const serviceType = document.getElementById('service_type');
            const mechanic = document.getElementById('mechanic');
            
            if (!branch.value || !serviceType.value || !mechanic.value) {
                alert('Silakan lengkapi cabang, kategori, dan mekanik terlebih dahulu.');
                return;
            }
        }
        
        // Validation for Step 2
        if (stepNumber === 3) {
            const branch = document.getElementById('branch');
            const serviceType = document.getElementById('service_type');
            const mechanic = document.getElementById('mechanic');
            const serviceDate = document.getElementById('service_date');
            const serviceTime = document.getElementById('service_time');
            const name = document.getElementById('name');
            const phone = document.getElementById('phone');
            const motorBrand = document.getElementById('motor_brand');
            const motorModel = document.getElementById('motor_model');
            const licensePlate = document.getElementById('license_plate');
            
            if (!serviceDate.value || !serviceTime.value || !name.value || !phone.value || !motorBrand.value || !motorModel.value || !licensePlate.value) {
                alert('Silakan lengkapi tanggal, jam, informasi diri, dan motor terlebih dahulu.');
                return;
            }
            
            // Populate confirmation details
            document.getElementById('confirm-branch').innerText = branch.value;
            document.getElementById('confirm-service').innerText = serviceType.options[serviceType.selectedIndex].text;
            document.getElementById('confirm-mechanic').innerText = mechanic.value;
            document.getElementById('confirm-name').innerText = name.value;
            document.getElementById('confirm-phone').innerText = phone.value;
            document.getElementById('confirm-motor').innerText = motorBrand.value + ' ' + motorModel.value;
            document.getElementById('confirm-plate').innerText = licensePlate.value;
            document.getElementById('confirm-schedule').innerText = serviceDate.value + ' @ ' + serviceTime.value + ' WIB';
            document.getElementById('confirm-complaints').innerText = document.getElementById('complaints').value || '-';

            // Populate billing details
            const serviceVal = serviceType.value;
            const price = categoryPrices[serviceVal] || 0;
            document.getElementById('billing-service-name').innerText = serviceType.options[serviceType.selectedIndex].text;
            document.getElementById('billing-subtotal').innerText = formatRupiah(price);
            document.getElementById('billing-total').innerText = formatRupiah(price);
        }
        
        // Toggle Panels
        document.querySelectorAll('.step-panel').forEach(panel => {
            panel.style.display = 'none';
        });
        document.getElementById(`panel-step-${stepNumber}`).style.display = 'block';
        
        // Update indicators
        document.querySelectorAll('.step-indicator').forEach(ind => {
            const step = parseInt(ind.getAttribute('data-step'));
            const numberBox = ind.querySelector('.step-number');
            const labelText = ind.querySelector('.step-label');
            
            if (step < stepNumber) {
                // Completed
                ind.classList.add('completed');
                ind.classList.remove('active');
                numberBox.style.backgroundColor = '#22c55e'; // Green check
                numberBox.style.color = 'white';
                numberBox.innerHTML = '<i data-lucide="check" style="width: 18px; height: 18px;"></i>';
            } else if (step === stepNumber) {
                // Active
                ind.classList.add('active');
                ind.classList.remove('completed');
                numberBox.style.backgroundColor = 'var(--accent)';
                numberBox.style.color = 'white';
                numberBox.innerText = step;
                labelText.style.fontWeight = '700';
                labelText.style.color = 'var(--text-primary)';
            } else {
                // Inactive
                ind.classList.remove('active', 'completed');
                numberBox.style.backgroundColor = 'var(--bg-tertiary)';
                numberBox.style.color = 'var(--text-secondary)';
                numberBox.innerText = step;
                labelText.style.fontWeight = '500';
                labelText.style.color = 'var(--text-secondary)';
            }
        });
        
        // Update progress line width
        const progressLine = document.getElementById('step-progress-line');
        const percentage = (stepNumber - 1) * 50;
        progressLine.style.width = `${percentage}%`;
        
        // Reinitialize Lucide Icons for dynamic check marks
        lucide.createIcons();
    }
</script>
@endsection
