@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="color: #4B0082;">
            <i class="bi bi-clock-history me-2" style="color: #9c27b0;"></i>My Orders
        </h1>
        <p class="text-muted">Track your order history and status</p>
    </div>

    @php
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
    @endphp

    @if($orders->count() > 0)
        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                        <!-- Order Header -->
                        <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #9b59b6 0%, #6a1b9a 100%);">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <h5 class="mb-0 fw-bold">{{ $order->order_number }}</h5>
                                    <small>{{ $order->created_at->format('M d, Y - h:i A') }}</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <small class="d-block">Total Amount</small>
                                        <h4 class="mb-0 fw-bold">PKR {{ number_format($order->grand_total) }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <small class="d-block">Payment Method</small>
                                        <span class="badge bg-white text-dark mt-1">{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <small class="d-block">Status</small>
                                        <span class="badge mt-1
                                            @if($order->status == 'completed') bg-success
                                            @elseif($order->status == 'pending') bg-warning
                                            @elseif($order->status == 'processing') bg-info
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3" style="color: #4B0082;">
                                <i class="bi bi-box-seam me-2"></i>Order Items
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->product && $item->product->image)
                                                            <img src="{{ asset('images/' . $item->product->image) }}" 
                                                                 alt="{{ $item->product->title }}" 
                                                                 class="rounded me-3"
                                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                                        @endif
                                                        <span class="fw-semibold">{{ $item->product->title ?? 'Product' }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark">{{ $item->quantity }}</span>
                                                </td>
                                                <td class="text-end">PKR {{ number_format($item->price) }}</td>
                                                <td class="text-end fw-bold">PKR {{ number_format($item->price * $item->quantity) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Delivery Charges:</td>
                                            <td class="text-end">PKR {{ number_format($order->delivery_charges) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold" style="font-size: 1.1rem; color: #4B0082;">Grand Total:</td>
                                            <td class="text-end fw-bold" style="font-size: 1.1rem; color: #9c27b0;">PKR {{ number_format($order->grand_total) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Shipping Address -->
                            <div class="mt-4 p-3 bg-light rounded">
                                <h6 class="fw-bold mb-2" style="color: #4B0082;">
                                    <i class="bi bi-geo-alt-fill me-2"></i>Shipping Address
                                </h6>
                                <p class="mb-0">{{ $order->address }}</p>
                                @if($order->notes)
                                    <p class="mb-0 mt-2 text-muted"><strong>Notes:</strong> {{ $order->notes }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #d8b5ff;"></i>
            <h3 class="mt-4 text-muted">No orders yet</h3>
            <p class="text-muted">Start shopping to see your orders here!</p>
            <a href="{{ route('products') }}" class="btn btn-lg text-white mt-3" style="background-color: #9c27b0;">
                <i class="bi bi-shop me-2"></i>Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
