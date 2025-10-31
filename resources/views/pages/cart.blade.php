@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">🛍️ Your Shopping Cart</h2>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @php $cart = $cart ?? session('cart', []); @endphp

        @if(empty($cart))
            <div class="text-center py-5">
                <h5 class="text-muted">Your cart is empty.</h5>
                <a href="{{ route('products') }}" class="btn btn-primary mt-3">Continue Shopping</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm">
                    <thead class="table-light text-center">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $grand = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $total = $item['product']['price'] * $item['quantity'];
                            $grand += $total;
                        @endphp
                        <tr class="text-center">
                            <td>{{ $item['product']['title'] }}</td>
                            <td><img src="{{ asset('images/' . $item['product']['image']) }}" width="70" height="70" style="object-fit: cover; border-radius: 10px;"></td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center" style="width: 70px;">
                                    <button class="btn btn-sm btn-outline-secondary">Update</button>
                                </form>
                            </td>
                            <td>Rs {{ number_format($item['product']['price']) }}</td>
                            <td>Rs {{ number_format($total) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="fw-bold text-center">
                        <td colspan="4" class="text-end">Grand Total:</td>
                        <td colspan="2" class="text-success">Rs {{ number_format($grand) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('products') }}" class="btn btn-outline-primary me-2">← Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @endif
    </div>
@endsection
