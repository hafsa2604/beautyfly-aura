@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        {{-- 🧾 Checkout Header --}}
        <div class="text-center mb-5">
            <h2 class="checkout-title text-center mb-4">✨ Checkout ✨</h2>
            <p class="text-muted">Complete your order by filling in the details below.</p>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success text-center shadow-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4 justify-content-center">
            {{-- 🧍‍♀️ Checkout Form --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 p-4">
                    <h4 class="fw-semibold mb-4 text-center text-secondary">🧾 Billing & Shipping Details</h4>

                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="03XXXXXXXXX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter your city" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="House #, Street, Area, etc." required></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary px-5">
                                <i class="bi bi-bag-check-fill me-2"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 🧮 Order Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 p-4 bg-light">
                    <h5 class="fw-semibold mb-3 text-center text-secondary">🛒 Order Summary</h5>
                    @php $cart = session('cart', []); $grand = 0; @endphp

                    @if(!empty($cart))
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cart as $item)
                                @php $total = $item['product']['price'] * $item['quantity']; $grand += $total; @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $item['product']['title'] }}</strong><br>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                    <span>Rs {{ number_format($total) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span class="text-success">Rs {{ number_format($grand) }}</span>
                        </div>
                    @else
                        <p class="text-center text-muted mb-0">Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
