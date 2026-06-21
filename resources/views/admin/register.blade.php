@extends('layouts.auth')

@section('title', 'Daftar - Turbo Garage')

@section('content')
    <div class="auth-header">
        <h2>Daftar</h2>
        <p>Buat akun baru Anda di sini</p>
    </div>

    @if($errors->any())
        <div class="auth-alert">
            <i data-lucide="alert-circle" style="width: 16px; height: 16px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('admin.register') }}" method="POST">
        @csrf
        
        <div class="auth-form-group">
            <label for="username">Nama Lengkap</label>
            <input type="text" name="username" id="username" class="auth-form-control" required placeholder="Nama Lengkap" value="{{ old('username') }}" autofocus>
        </div>

        <div class="auth-form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="auth-form-control" required placeholder="nama@email.com" value="{{ old('email') }}">
        </div>
        
        <div class="auth-form-group">
            <label for="password">Password</label>
            <div style="position: relative; width: 100%;">
                <input type="password" name="password" id="password" class="auth-form-control" required placeholder="Masukkan password" style="padding-right: 44px;">
                <button type="button" onclick="togglePasswordVisibility('password')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-secondary); padding: 0;">
                    <i data-lucide="eye" id="password-eye-icon" style="width: 18px; height: 18px;"></i>
                </button>
            </div>
        </div>

        <div class="auth-form-group" style="margin-bottom: 24px;">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div style="position: relative; width: 100%;">
                <input type="password" id="password_confirmation" class="auth-form-control" required placeholder="Konfirmasi password" style="padding-right: 44px;">
                <button type="button" onclick="togglePasswordVisibility('password_confirmation')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-secondary); padding: 0;">
                    <i data-lucide="eye" id="password_confirmation-eye-icon" style="width: 18px; height: 18px;"></i>
                </button>
            </div>
        </div>
        
        <button type="submit" class="auth-btn-submit" style="margin-top: 0;">
            Daftar
        </button>
    </form>

    <div class="auth-footer-link">
        Sudah punya akun? <a href="{{ route('admin.login') }}" style="color: #5a52e5; font-weight: 700;">Masuk sekarang</a>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
@endsection
