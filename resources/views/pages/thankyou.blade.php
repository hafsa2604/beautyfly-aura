@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Success Animation Section -->
            <div class="text-center mb-5">
                <div class="success-animation mb-4">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h1 class="thank-you-title mb-3">
                    <span class="gradient-text">Thank You!</span> 🎉
                </h1>
                <p class="lead text-muted">Your order has been placed successfully!</p>
                <div class="order-number-badge">
                    <i class="bi bi-receipt me-2"></i>
                    Order Number: <strong>{{ $order->order_number }}</strong>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="order-summary-card mb-4">
                <div class="card-header-custom">
                    <h4 class="mb-0">
                        <i class="bi bi-bag-check me-2"></i>Order Summary
                    </h4>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <!-- Order Items -->
                        <div class="col-lg-8">
                            <h5 class="section-title mb-3">
                                <i class="bi bi-box-seam me-2"></i>Items Ordered
                            </h5>
                            <div class="order-items-list">
                                @foreach($order->items as $item)
                                    <div class="order-item-card">
                                        <div class="order-item-image">
                                            <img src="{{ !empty($item->product->image) ? asset('images/' . $item->product->image) : asset('images/placeholder.jpg') }}" 
                                                 alt="{{ $item->product->title }}"
                                                 onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                                        </div>
                                        <div class="order-item-details">
                                            <h6 class="order-item-title">{{ $item->product->title }}</h6>
                                            <div class="order-item-meta">
                                                <span class="quantity-badge">
                                                    <i class="bi bi-123 me-1"></i>Quantity: {{ $item->quantity }}
                                                </span>
                                                <span class="price-badge">
                                                    <i class="bi bi-currency-rupee me-1"></i>PKR {{ number_format($item->price, 2) }} each
                                                </span>
                                            </div>
                                        </div>
                                        <div class="order-item-total">
                                            <strong>PKR {{ number_format($item->price * $item->quantity, 2) }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Total -->
                        <div class="col-lg-4">
                            <div class="order-total-card">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-calculator me-2"></i>Total Amount
                                </h5>
                                <div class="total-breakdown">
                                    <div class="total-row">
                                        <span>Subtotal:</span>
                                        <span>PKR {{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                    <div class="total-row">
                                        <span>Delivery Charges:</span>
                                        <span>
                                            @if($order->delivery_charges > 0)
                                                PKR {{ number_format($order->delivery_charges, 2) }}
                                                <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                                    <i class="bi bi-info-circle me-1"></i>Applied for orders below PKR 2,000
                                                </small>
                                            @else
                                                <span class="text-success">FREE</span>
                                                <small class="text-success d-block mt-1" style="font-size: 0.75rem;">
                                                    <i class="bi bi-check-circle me-1"></i>Free delivery for orders PKR 2,000+
                                                </small>
                                            @endif
                                        </span>
                                    </div>
                                    <hr class="my-3">
                                    <div class="total-row final-total">
                                        <span><strong>Grand Total:</strong></span>
                                        <span><strong>PKR {{ number_format($order->total_amount + $order->delivery_charges, 2) }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information Card -->
            <div class="customer-info-card mb-4">
                <div class="card-header-custom">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>Customer Information
                    </h4>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-person-fill info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Full Name</small>
                                    <strong>{{ $order->name }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-envelope-fill info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Email Address</small>
                                    <strong>{{ $order->email }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-telephone-fill info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Phone Number</small>
                                    <strong>{{ $order->phone }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Delivery Address</small>
                                    <strong>{{ $order->address }}</strong>
                                </div>
                            </div>
                        </div>
                        @if($order->notes)
                        <div class="col-12 mb-3">
                            <div class="info-item">
                                <i class="bi bi-sticky-fill info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Additional Notes</small>
                                    <strong>{{ $order->notes }}</strong>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="info-item">
                                <i class="bi bi-clock-history info-icon"></i>
                                <div>
                                    <small class="text-muted d-block">Order Date</small>
                                    <strong>{{ $order->created_at->format('F d, Y \a\t h:i A') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="status-card mb-4">
                <div class="status-content">
                    <div class="status-icon-wrapper">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="status-text">
                        <h5 class="mb-2">Order Status</h5>
                        <span class="status-badge status-pending">
                            <i class="bi bi-clock me-1"></i>{{ ucfirst($order->status) }}
                        </span>
                        <p class="mt-2 mb-0 text-muted small">
                            We'll send you an email confirmation shortly with tracking details.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center action-buttons">
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg me-3">
                    <i class="bi bi-bag me-2"></i>Continue Shopping
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-house me-2"></i>Back to Home
                </a>
            </div>

            <!-- Help Section -->
            <div class="help-section mt-5">
                <div class="help-card">
                    <h5 class="mb-3">
                        <i class="bi bi-question-circle me-2"></i>Need Help?
                    </h5>
                    <p class="text-muted mb-3">
                        If you have any questions about your order, please don't hesitate to contact us.
                    </p>
                    <div class="help-links">
                        <a href="{{ route('contact') }}" class="help-link">
                            <i class="bi bi-envelope me-2"></i>Contact Us
                        </a>
                        <a href="tel:+923001234567" class="help-link">
                            <i class="bi bi-telephone me-2"></i>Call Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Thank You Page Styles */
.thank-you-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
}

.gradient-text {
    background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.success-animation {
    animation: bounceIn 0.8s ease-out;
}

.success-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(122, 31, 162, 0.3);
    animation: scaleIn 0.6s ease-out;
}

.success-icon i {
    font-size: 4rem;
    color: white;
    animation: checkmark 0.5s ease-out 0.3s both;
}

@keyframes bounceIn {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes scaleIn {
    0% { transform: scale(0); }
    100% { transform: scale(1); }
}

@keyframes checkmark {
    0% { transform: scale(0) rotate(45deg); }
    100% { transform: scale(1) rotate(0deg); }
}

.order-number-badge {
    display: inline-block;
    background: rgba(122, 31, 162, 0.1);
    color: #7a1fa2;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 1.1rem;
    margin-top: 1rem;
    border: 2px solid rgba(122, 31, 162, 0.2);
}

.order-summary-card,
.customer-info-card,
.status-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.card-header-custom {
    background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
    color: white;
    padding: 1.5rem 2rem;
    border: none;
}

.card-body-custom {
    padding: 2rem;
}

.section-title {
    color: #4B0082;
    font-weight: 600;
    font-size: 1.25rem;
}

.order-items-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    background: rgba(248, 230, 255, 0.3);
    border-radius: 15px;
    border: 1px solid rgba(122, 31, 162, 0.1);
    transition: all 0.3s ease;
}

.order-item-card:hover {
    background: rgba(248, 230, 255, 0.5);
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(122, 31, 162, 0.1);
}

.order-item-image {
    width: 100px;
    height: 100px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    border: 2px solid rgba(122, 31, 162, 0.2);
}

.order-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.order-item-details {
    flex-grow: 1;
}

.order-item-title {
    color: #4B0082;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.order-item-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.quantity-badge,
.price-badge {
    background: rgba(122, 31, 162, 0.1);
    color: #7a1fa2;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.order-item-total {
    font-size: 1.25rem;
    color: #4B0082;
    font-weight: 700;
    min-width: 120px;
    text-align: right;
}

.order-total-card {
    background: linear-gradient(135deg, rgba(248, 230, 255, 0.5) 0%, rgba(255, 255, 255, 0.8) 100%);
    padding: 2rem;
    border-radius: 15px;
    border: 2px solid rgba(122, 31, 162, 0.2);
    position: sticky;
    top: 20px;
}

.total-breakdown {
    font-size: 1rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    color: #3b1c47;
}

.total-row.final-total {
    font-size: 1.25rem;
    padding-top: 1rem;
    border-top: 2px solid rgba(122, 31, 162, 0.2);
    margin-top: 0.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: rgba(248, 230, 255, 0.2);
    border-radius: 12px;
    border-left: 4px solid #7a1fa2;
}

.info-icon {
    font-size: 1.5rem;
    color: #7a1fa2;
    margin-top: 0.25rem;
}

.status-card {
    background: linear-gradient(135deg, rgba(248, 230, 255, 0.5) 0%, rgba(255, 255, 255, 0.8) 100%);
}

.status-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.status-icon-wrapper {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.status-icon-wrapper i {
    font-size: 2rem;
    color: white;
}

.status-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1rem;
}

.status-pending {
    background: rgba(255, 193, 7, 0.2);
    color: #856404;
    border: 2px solid rgba(255, 193, 7, 0.3);
}

.action-buttons {
    margin-top: 3rem;
}

.action-buttons .btn {
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(122, 31, 162, 0.3);
}

.help-section {
    margin-top: 4rem;
    padding-top: 2rem;
    border-top: 2px solid rgba(122, 31, 162, 0.1);
}

.help-card {
    background: rgba(248, 230, 255, 0.3);
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
}

.help-links {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.help-link {
    color: #7a1fa2;
    text-decoration: none;
    font-weight: 600;
    padding: 10px 20px;
    border: 2px solid #7a1fa2;
    border-radius: 25px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.help-link:hover {
    background: #7a1fa2;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(122, 31, 162, 0.3);
}

@media (max-width: 768px) {
    .thank-you-title {
        font-size: 2rem;
    }
    
    .success-icon {
        width: 80px;
        height: 80px;
    }
    
    .success-icon i {
        font-size: 2.5rem;
    }
    
    .order-item-card {
        flex-direction: column;
        text-align: center;
    }
    
    .order-item-total {
        text-align: center;
    }
    
    .status-content {
        flex-direction: column;
        text-align: center;
    }
    
    .action-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
}
</style>
@endsection

