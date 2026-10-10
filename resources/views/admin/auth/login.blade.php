@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')

<style>
     
    .admin-login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 15px;
        position: relative;
        overflow: hidden;
       
    }

    .login-card {
        width: 100%;
        max-width: 450px;
        background: #fff;
        border: 1px solid rgba(226, 232, 240, .85);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(30, 41, 59, .10);
        position: relative;
        z-index: 1;
    }

    .login-header {
        padding: 20px;
        text-align: center;
        color: #000;
        background: #c1b6ff;
        position: relative;
         background:
            radial-gradient(circle at 10% 10%, rgba(59, 130, 246, .13), transparent 30%),
            radial-gradient(circle at 90% 90%, rgba(99, 102, 241, .13), transparent 30%),
            #f5f7fc;
    }

   

    .login-header h3 {
        font-size: 27px;
        font-weight: 750;
        letter-spacing: -.7px;
        margin-bottom: 9px;
    }

    .login-header p {
        font-size: 14px;
        color: rgba(255, 255, 255, .82);
        margin: 0;
    }

    .login-body {
        padding: 25px;
    }

    .login-label {
        display: block;
        margin-bottom: 9px;
        color: #334155;
        font-size: 14px;
        font-weight: 650;
    }

    .login-input-group {
        position: relative;
    }

    .login-input {
        width: 100%;
        height: 53px;
        padding: 12px 15px 12px 45px;
        border: 1px solid #dce3ee;
        border-radius: 11px;
        background: #fbfcff;
        color: #1e293b;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .login-input::placeholder {
        color: #9aa6b8;
    }

    .login-input:focus {
        background: #fff;
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, .10);
    }

    .login-input.is-invalid {
        border-color: #dc3545;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 17px;
        pointer-events: none;
    }

    .password-toggle {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        padding: 5px;
        border: 0;
        background: transparent;
        color: #64748b;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
    }

    .password-toggle:hover {
        color: #4338ca;
    }

    .login-check {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: #4338ca;
    }

    .login-check-label {
        color: #64748b;
        font-size: 13px;
        cursor: pointer;
    }

   

    .login-footer {
        padding: 19px 15px;
        border-top: 1px solid #eef2f7;
        background: #fcfdff;
        text-align: center;
        color: #64748b;
        font-size: 12px;
    }

    .security-note {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        color: #64748b;
        font-size: 12px;
    }

    .security-dot {
        width: 7px;
        height: 7px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
    }

    .login-copyright {
        margin-top: 22px;
        color: #94a3b8;
        font-size: 12px;
        text-align: center;
    }

    .login-copyright strong {
        color: #64748b;
    }

    .fs-12{
        font-size:12px
    }
    .fs-16{
        font-size:16px
    }
</style>

<div class="admin-login-wrapper">
    <div class="w-100" style="max-width: 450px;">

        <div class="login-card">

            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">
                     <img src="{{ asset('assets/images/abyzone-logo.png') }}" alt="ABYzone" height="50">
                </div>

                <h3 class="fs-5 mt-3 mb-0"> Welcome Back!</h3>
                <p class="text-dark fs-12">Sign in to access your admin dashboard.</p>
            </div>

            <!-- Login Form -->
            <div class="login-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-3"
                         role="alert">
                        <strong>
                            <i class="fa-solid fa-circle-xmark input-icon text-danger"></i>
                            Login Failed!
                        </strong>

                        @foreach ($errors->all() as $error)
                            <div class="small mt-1">{{ $error }}</div>
                        @endforeach

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="login-label">
                            Email Address
                        </label>

                        <div class="login-input-group">
                            <i class="fa-solid fa-envelope input-icon"></i>

                            <input
                                type="email"
                                class="login-input @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email address"
                                autocomplete="username"
                                required
                                autofocus
                            >
                        </div>

                        @error('email')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="login-label">
                            Password
                        </label>

                        <div class="login-input-group">
                            <i class="fa-solid fa-lock input-icon"></i>

                            <input
                                type="password"
                                class="login-input @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                style="padding-right: 65px;"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                id="togglePassword"
                                aria-label="Show password"
                            >
                                Show
                            </button>
                        </div>

                        @error('password')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="d-flex align-items-center mb-4">
                        <input
                            class="login-check me-2"
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <label class="login-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn theme_btn w-100 fs-16 fw-bold">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        Sign In to Dashboard
                    </button>
                </form>

                <div class="security-note mt-4">
                    <i class="fa-solid fa-shield-check text-success"></i>
                    Secure Admin Access
                    <span class="security-dot"></span>
                    Protected Login
                </div>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <i class="bi bi-lock-fill me-1"></i>
                Your credentials are protected.
            </div>
        </div>

        <div class="login-copyright">
            &copy; {{ date('Y') }} <strong>Abyzone</strong>.
            All rights reserved.
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        if (passwordInput && toggleButton) {
            toggleButton.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';

                passwordInput.type = isPassword ? 'text' : 'password';
                toggleButton.textContent = isPassword ? 'Hide' : 'Show';
                toggleButton.setAttribute(
                    'aria-label',
                    isPassword ? 'Hide password' : 'Show password'
                );
            });
        }
    });
</script>


@endsection
