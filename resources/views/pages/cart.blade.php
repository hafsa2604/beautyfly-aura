@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3" style="color: #4B0082;">
                <i class="bi bi-cart3 me-2" style="color: #f7b9f4;"></i>Your Shopping Cart
            </h1>
            <p class="text-muted">Review your items before checkout</p>
        </div>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @php $cart = $cart ?? session('cart', []); @endphp

        @if(empty($cart))
            <div class="text-center py-5">
                <div class="empty-cart">
                    <i class="bi bi-cart-x" style="font-size: 5rem; color: #f7b9f4;"></i>
                    <h4 class="mt-4 mb-3" style="color: #4B0082;">Your cart is empty</h4>
                    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        @else
            <div class="cart-table-wrapper">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                        <tr style="background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%); color: white;">
                            <th style="border: none;">Product</th>
                            <th style="border: none;">Image</th>
                            <th style="border: none;">Quantity</th>
                            <th style="border: none;">Price</th>
                            <th style="border: none;">Total</th>
                            <th style="border: none;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $grand = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php
                                $total = $item['product']->price * $item['quantity'];
                                $grand += $total;
                            @endphp
                            <tr>
                                <td>
                                    <strong style="color: #4B0082;">{{ $item['product']->title }}</strong>
                                </td>
                                <td>
                                    <img src="{{ !empty($item['product']->image) ? asset('images/' . $item['product']->image) : asset('images/placeholder.jpg') }}" 
                                         width="80" 
                                         height="80" 
                                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                                         style="object-fit: cover; border-radius: 10px; border: 2px solid #E5E7EB;">
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center" style="width: 80px; border-radius: 8px;">
                                        <button class="btn btn-sm btn-outline-purple" type="submit">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><strong style="color: #4B0082;">PKR {{ number_format($item['product']->price, 2) }}</strong></td>
                                <td><strong style="color: #4B0082; font-size: 1.1rem;">PKR {{ number_format($total, 2) }}</strong></td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item from cart?');">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        @php 
                            $deliveryCharges = $grand < 2000 ? 200 : 0;
                            $grandTotal = $grand + $deliveryCharges;
                        @endphp
                        <tr>
                            <td colspan="4" class="text-end" style="padding: 0.75rem 1.5rem;">
                                Subtotal:
                            </td>
                            <td colspan="2" style="padding: 0.75rem 1.5rem;">
                                PKR {{ number_format($grand, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end" style="padding: 0.75rem 1.5rem;">
                                Delivery Charges:
                            </td>
                            <td colspan="2" style="padding: 0.75rem 1.5rem;">
                                @if($deliveryCharges > 0)
                                    PKR {{ number_format($deliveryCharges, 2) }}
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">(Orders below PKR 2,000)</small>
                                @else
                                    <span class="text-success">FREE</span>
                                    <small class="text-success d-block" style="font-size: 0.75rem;">(Orders PKR 2,000+)</small>
                                @endif
                            </td>
                        </tr>
                        <tr style="background: rgba(248, 230, 255, 0.5);">
                            <td colspan="4" class="text-end fw-bold" style="font-size: 1.25rem; padding: 1.5rem;">
                                Grand Total:
                            </td>
                            <td colspan="2" class="fw-bold" style="color: #4B0082; font-size: 1.5rem; padding: 1.5rem;">
                                PKR {{ number_format($grandTotal, 2) }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="cart-actions mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <a href="{{ route('products') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                </a>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                </a>
            </div>
        @endif
    </div>
@endsection
