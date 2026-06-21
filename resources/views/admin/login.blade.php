@extends('layouts.auth')

@section('title', 'Masuk - Turbo Garage')

@section('content')
    <div class="auth-header">
        <h2>Masuk</h2>
        <p>Silakan masuk untuk melanjutkan</p>
    </div>

    @if($errors->any())
        <div class="auth-alert">
            <i data-lucide="alert-circle" style="width: 16px; height: 16px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        
        <div class="auth-form-group">
            <label for="username">username/email</label>
            <input type="text" name="username" id="username" class="auth-form-control" required placeholder="admin" value="{{ old('username') }}" autofocus>
        </div>
        
        <div class="auth-form-group" style="margin-bottom: 16px;">
            <label for="password">password</label>
            <div style="position: relative; width: 100%;">
                <input type="password" name="password" id="password" class="auth-form-control" required placeholder="admin123" style="padding-right: 44px;">
                <button type="button" onclick="togglePasswordVisibility('password')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-secondary); padding: 0;">
                    <i data-lucide="eye" id="password-eye-icon" style="width: 18px; height: 18px;"></i>
                </button>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-top: -8px; margin-bottom: 24px;">
            <a href="#" style="font-size: 0.85rem; color: #5a52e5; text-decoration: none; font-weight: 600;">Lupa password?</a>
        </div>
        
        <button type="submit" class="auth-btn-submit" style="margin-top: 0;">
            Masuk
        </button>
    </form>

    <div class="auth-footer-link">
        Belum punya akun? <a href="{{ route('admin.register') }}" style="color: #5a52e5; font-weight: 700;">Daftar sekarang</a>
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
