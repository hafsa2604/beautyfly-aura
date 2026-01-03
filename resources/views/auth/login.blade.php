@extends('layouts.layout')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-body p-5">

                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-box-seam" style="font-size: 3.5rem; color: #4B0082;"></i>
                        </div>
                        <h2 class="fw-bold mb-2" style="color: #4B0082;">Welcome Back</h2>
                        <p class="text-muted small">Sign in to continue to BeautyFly Aura</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-envelope me-2"></i>Email Address
                            </label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autofocus autocomplete="username"
                                   placeholder="Enter your email"
                                   style="border-radius: 10px; border: 2px solid #e0e0e0;">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input id="password" type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password"
                                       placeholder="Enter your password"
                                       style="border-radius: 10px 0 0 10px; border: 2px solid #e0e0e0; border-right: none;">
                                <button class="btn btn-outline-secondary" type="button" 
                                        onclick="togglePasswordVisibility('password')"
                                        style="border-radius: 0 10px 10px 0; border: 2px solid #e0e0e0; border-left: none;">
                                    <i class="bi bi-eye" id="password-toggle-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                <label class="form-check-label small fw-semibold" for="remember_me" style="color: #4B0082;">
                                    Remember me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small fw-semibold" style="color: #4B0082;">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-lg text-white fw-semibold" 
                                    style="background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); border-radius: 10px; padding: 12px;">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0 small" style="color: #4B0082;">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #7b1fa2;">
                                    Create Account
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-toggle-icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection
