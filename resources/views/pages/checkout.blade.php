@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        {{-- 🧾 Checkout Header --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3" style="color: #4B0082;">
                <i class="bi bi-credit-card me-2" style="color: #f7b9f4;"></i>Checkout
            </h1>
            <p class="text-muted">Complete your order by filling in the details below</p>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 justify-content-center">
            {{-- 🧍‍♀️ Checkout Form --}}
            <div class="col-lg-7">
                <div class="checkout-card">
                    <div class="card-header-custom">
                        <h4 class="mb-0">
                            <i class="bi bi-person-badge me-2"></i>Billing & Shipping Details
                        </h4>
                    </div>
                    <div class="card-body-custom">
                        <form method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="03XXXXXXXXX" value="{{ old('phone') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Complete Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" rows="4" placeholder="House #, Street, Area, City, etc." required>{{ old('address') }}</textarea>
                                <small class="text-muted">Please include your complete address including city and postal code</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Additional Notes (Optional)</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                            </div>

                            <div class="text-center mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-bag-check me-2"></i>Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 🧮 Order Summary --}}
            <div class="col-lg-4">
                <div class="checkout-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="bi bi-cart-check me-2"></i>Order Summary
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        @php 
                            $cart = session('cart', []); 
                            $subtotal = 0; 
                        @endphp

                        @if(!empty($cart))
                            <div class="order-items mb-4">
                                @foreach($cart as $id => $item)
                                    @php $total = $item['product']->price * $item['quantity']; $subtotal += $total; @endphp
                                    <div class="order-item d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <strong style="color: #4B0082;">{{ $item['product']->title }}</strong>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                                <span class="text-muted">×</span>
                                                <small class="text-muted">PKR {{ number_format($item['product']->price, 2) }}</small>
                                            </div>
                                        </div>
                                        <strong style="color: #4B0082;">PKR {{ number_format($total, 2) }}</strong>
                                    </div>
                                @endforeach
                            </div>
                            
                            @php 
                                $deliveryCharges = $subtotal < 2000 ? 200 : 0;
                                $grandTotal = $subtotal + $deliveryCharges;
                            @endphp
                            
                            <div class="order-total p-3 rounded" style="background: rgba(248, 230, 255, 0.5);">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>PKR {{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Delivery Charges:</span>
                                    <span>
                                        @if($deliveryCharges > 0)
                                            PKR {{ number_format($deliveryCharges, 2) }}
                                            <small class="text-muted d-block">(Orders below PKR 2,000)</small>
                                        @else
                                            <span class="text-success">FREE</span>
                                            <small class="text-success d-block">(Orders PKR 2,000+)</small>
                                        @endif
                                    </span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="font-size: 1.1rem;">Grand Total:</span>
                                    <span class="fw-bold" style="color: #4B0082; font-size: 1.5rem;">PKR {{ number_format($grandTotal, 2) }}</span>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-info-circle me-1"></i>Inclusive of all taxes
                                </small>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-cart-x" style="font-size: 3rem; color: #f7b9f4;"></i>
                                <p class="text-muted mt-3 mb-0">Your cart is empty.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
