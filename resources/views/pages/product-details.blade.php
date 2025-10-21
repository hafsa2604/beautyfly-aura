@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/'.$product['image']) }}" class="img-fluid rounded shadow" alt="{{ $product['title'] }}">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $product['title'] }}</h2>
                <p class="text-muted mb-2"><strong>Skin Type:</strong> {{ ucfirst($product['type']) }}</p>
                <p><strong>Description:</strong> {{ $product['desc'] }}</p>
                <p><strong>Benefits:</strong> {{ $product['benefits'] }}</p>
                <p><strong>Usage:</strong> {{ $product['usage'] }}</p>
                <h4 class="text-success mt-3">PKR {{ number_format($product['price']) }}</h4>

                <!-- Add to Cart Button -->
                <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="mt-3">
                    @csrf
                    <button class="btn btn-success px-4">Add to Cart</button>
                </form>
            </div>
        </div>

        <hr class="my-5">

        <!-- Customer Reviews Section -->
        <h4>Customer Reviews</h4>

        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <div class="mt-3">
            @forelse($reviews as $r)
                <div class="border rounded p-3 mb-2">
                    <strong>{{ $r['name'] }}</strong>
                    <p class="mb-0">{{ $r['review'] }}</p>
                </div>
            @empty
                <p>No reviews yet. Be the first to review!</p>
            @endforelse
        </div>

        <!-- Review Form -->
        <div class="mt-4">
            <h5>Write a Review</h5>
            <form method="POST" action="{{ route('product.review', $product['id']) }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                </div>
                <div class="mb-3">
                    <textarea name="review" class="form-control" placeholder="Write your review..." rows="3" required></textarea>
                </div>
                <button class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>
@endsection

