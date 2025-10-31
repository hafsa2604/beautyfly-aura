@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">🛍 Checkout</h2>
        <p class="text-center text-muted mb-4">
            Please fill out your details to complete your order.
        </p>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}" class="mx-auto" style="max-width: 600px;">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Address</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Enter your shipping address" required></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100">Proceed to Payment</button>
        </form>
    </div>
@endsection

