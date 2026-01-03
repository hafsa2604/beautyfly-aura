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

                            <!-- Payment Method Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Payment Method <span class="text-danger">*</span></label>
                                <div class="payment-methods">
                                    <!-- Cash on Delivery -->
                                    <div class="form-check payment-option mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cash_on_delivery" checked required>
                                        <label class="form-check-label w-100" for="cod">
                                            <div class="d-flex align-items-center justify-content-between p-3 border rounded" style="cursor: pointer;">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-cash-coin me-3" style="font-size: 1.5rem; color: #4B0082;"></i>
                                                    <div>
                                                        <strong>Cash on Delivery</strong>
                                                        <small class="d-block text-muted">Pay when you receive your order</small>
                                                    </div>
                                                </div>
                                                <i class="bi bi-check-circle-fill text-success" style="font-size: 1.2rem;"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Mastercard -->
                                    <div class="form-check payment-option mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="mastercard" value="mastercard" required>
                                        <label class="form-check-label w-100" for="mastercard">
                                            <div class="d-flex align-items-center justify-content-between p-3 border rounded" style="cursor: pointer;">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-credit-card me-3" style="font-size: 1.5rem; color: #4B0082;"></i>
                                                    <div>
                                                        <strong>Mastercard</strong>
                                                        <small class="d-block text-muted">Pay securely with your Mastercard</small>
                                                    </div>
                                                </div>
                                                <i class="bi bi-circle" style="font-size: 1.2rem; color: #ddd;"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- PayPal -->
                                    <div class="form-check payment-option mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" required>
                                        <label class="form-check-label w-100" for="paypal">
                                            <div class="d-flex align-items-center justify-content-between p-3 border rounded" style="cursor: pointer;">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-paypal me-3" style="font-size: 1.5rem; color: #4B0082;"></i>
                                                    <div>
                                                        <strong>PayPal</strong>
                                                        <small class="d-block text-muted">Pay with your PayPal account</small>
                                                    </div>
                                                </div>
                                                <i class="bi bi-circle" style="font-size: 1.2rem; color: #ddd;"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Mastercard Details (Hidden by default) -->
                                <div id="mastercard-details" class="mt-4 p-4 border rounded shadow-sm bg-light d-none">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: #4B0082;">
                                        <i class="bi bi-credit-card-2-front me-2"></i>Mastercard Details
                                    </h6>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Cardholder Name</label>
                                        <input type="text" name="card_name" class="form-control" placeholder="Name on card">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Card Number</label>
                                        <div class="input-group">
                                            <input type="text" name="card_number" class="form-control" placeholder="0000 0000 0000 0000">
                                            <span class="input-group-text bg-white"><i class="bi bi-credit-card"></i></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">Expiry Date</label>
                                            <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">CVV</label>
                                            <input type="password" name="card_cvv" class="form-control" placeholder="123">
                                        </div>
                                    </div>
                                </div>

                                <!-- PayPal Redirect Message (Hidden by default) -->
                                <div id="paypal-details" class="mt-4 p-4 border rounded shadow-sm bg-light d-none text-center">
                                    <i class="bi bi-paypal mb-2" style="font-size: 2.5rem; color: #003087;"></i>
                                    <h6 class="fw-bold" style="color: #4B0082;">PayPal Checkout</h6>
                                    <p class="text-muted small">You will be redirected to the PayPal secure site to complete your payment after clicking "Place Order".</p>
                                </div>
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

    <style>
        .payment-option input[type="radio"] {
            display: none;
        }
        
        .payment-option input[type="radio"]:checked + label .border {
            border-color: #4B0082 !important;
            border-width: 2px !important;
            background-color: rgba(75, 0, 130, 0.05);
        }
        
        .payment-option input[type="radio"]:checked + label .bi-circle {
            display: none;
        }
        
        .payment-option input[type="radio"]:not(:checked) + label .bi-check-circle-fill {
            display: none;
        }
        
        .payment-option label:hover .border {
            border-color: #9c27b0 !important;
            background-color: rgba(156, 39, 176, 0.02);
        }
    </style>

    <script>
        // Update visual feedback and detail forms when payment method changes
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Handle Radio Icons
                document.querySelectorAll('.payment-option label .bi-check-circle-fill').forEach(icon => {
                    icon.style.display = 'none';
                });
                document.querySelectorAll('.payment-option label .bi-circle').forEach(icon => {
                    icon.style.display = 'inline-block';
                });
                
                const selectedLabel = this.nextElementSibling;
                const checkIcon = selectedLabel.querySelector('.bi-check-circle-fill');
                const circleIcon = selectedLabel.querySelector('.bi-circle');
                
                if (checkIcon) checkIcon.style.display = 'inline-block';
                if (circleIcon) circleIcon.style.display = 'none';

                // Handle Detail Sections
                const mastercardDetails = document.getElementById('mastercard-details');
                const paypalDetails = document.getElementById('paypal-details');
                const cardInputs = mastercardDetails.querySelectorAll('input');

                // Reset all
                mastercardDetails.classList.add('d-none');
                paypalDetails.classList.add('d-none');
                cardInputs.forEach(input => input.required = false);

                // Show selected
                if (this.value === 'mastercard') {
                    mastercardDetails.classList.remove('d-none');
                    cardInputs.forEach(input => input.required = true);
                } else if (this.value === 'paypal') {
                    paypalDetails.classList.remove('d-none');
                }
            });
        });
    </script>
@endsection
