@extends('layouts.layout')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-body p-5">

                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-person-plus-fill" style="font-size: 3.5rem; color: #4B0082;"></i>
                        </div>
                        <h2 class="fw-bold mb-2" style="color: #4B0082;">Create Account</h2>
                        <p class="text-muted small">Join BeautyFly Aura and discover premium skincare</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-person me-2"></i>Full Name
                            </label>
                            <input id="name" type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   required autofocus autocomplete="name"
                                   placeholder="Enter your full name"
                                   style="border-radius: 10px; border: 2px solid rgba(75, 0, 130, 0.2); background: rgba(255, 255, 255, 0.9);">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-envelope me-2"></i>Email Address
                            </label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autocomplete="username"
                                   placeholder="Enter your email"
                                   style="border-radius: 10px; border: 2px solid rgba(75, 0, 130, 0.2); background: rgba(255, 255, 255, 0.9);">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input id="password" type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password"
                                       placeholder="Create a password"
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

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold" style="color: #4B0082;">
                                <i class="bi bi-shield-check me-2"></i>Confirm Password
                            </label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" 
                                       class="form-control form-control-lg" 
                                       name="password_confirmation" required autocomplete="new-password"
                                       placeholder="Confirm your password"
                                       style="border-radius: 10px 0 0 10px; border: 2px solid rgba(75, 0, 130, 0.2); border-right: none; background: rgba(255, 255, 255, 0.9);">
                                <button class="btn btn-outline-secondary" type="button" 
                                        onclick="togglePasswordVisibility('password_confirmation')"
                                        style="border-radius: 0 10px 10px 0; border: 2px solid rgba(75, 0, 130, 0.2); border-left: none; background: rgba(255, 255, 255, 0.9);">
                                    <i class="bi bi-eye" id="password_confirmation-toggle-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-lg text-white fw-semibold" 
                                    style="background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); border-radius: 10px; padding: 12px;">
                                <i class="bi bi-person-check me-2"></i>Create Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-0 small" style="color: #4B0082;">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #7b1fa2;">
                                    Sign In
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
