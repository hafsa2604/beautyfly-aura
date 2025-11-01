@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- 🖼️ Product Image -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="{{ asset('images/'.$product['image']) }}"
                     alt="{{ $product['title'] }}"
                     class="img-fluid rounded shadow-lg"
                     style="max-height: 400px; object-fit: cover;">
            </div>

            <!-- 💜 Product Details -->
            <div class="col-md-6">
                <h2 class="fw-bold" style="color: #3b1c47;">{{ $product['title'] }}</h2>
                <p class="text-muted mb-2"><strong>Skin Type:</strong> {{ ucfirst($product['type']) }}</p>

                <p><strong>Description:</strong> {{ $product['desc'] }}</p>
                <p><strong>Benefits:</strong> {{ $product['benefits'] }}</p>
                <p><strong>Usage:</strong> {{ $product['usage'] }}</p>

                <h4 class="fw-bold mt-3" style="color: #4B0082;">PKR {{ number_format($product['price']) }}</h4>

                <!-- 🛒 Add to Cart -->
                <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="mt-4">
                    @csrf
                    <button class="btn px-4 py-2 shadow-sm"
                            style="background: linear-gradient(135deg, #d6b3ff, #f7b9f4); border: none; color: #3b1c47; font-weight: 600; border-radius: 8px;">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>

                <!-- 🌿 Product Highlights -->
                <ul class="mt-4 small text-muted">
                    <li>✨ 100% Dermatologically Tested</li>
                    <li>🐰 Cruelty-Free and Vegan</li>
                    <li>🚚 Free Delivery on Orders Over PKR 2000</li>
                </ul>
            </div>
        </div>

        <hr class="my-5" style="border-color: rgba(59,28,71,0.1);">

        <!-- 💬 Customer Reviews Section -->
        <div class="reviews-section">
            <h3 class="fw-bold mb-4" style="color: #3b1c47;">Customer Reviews</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @forelse($reviews as $r)
                <div class="review-card p-3 mb-3 rounded shadow-sm bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong style="color: #4B0082;">{{ $r['name'] }}</strong>
                        <span class="text-warning small">★★★★★</span>
                    </div>
                    <p class="mt-2 mb-0 text-muted">{{ $r['review'] }}</p>
                </div>
            @empty
                <p class="text-muted">No reviews yet — be the first to share your experience 💜</p>
            @endforelse

            <!-- ✍️ Review Form -->
            <div class="mt-5 p-4 rounded shadow-sm" style="background: #f9f4ff;">
                <h5 class="fw-bold mb-3" style="color: #3b1c47;">Write a Review</h5>
                <form method="POST" action="{{ route('product.review', $product['id']) }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control border-0 shadow-sm" placeholder="Your name" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="review" class="form-control border-0 shadow-sm" placeholder="Write your review..." rows="3" required></textarea>
                    </div>
                    <button class="btn px-4 py-2"
                            style="background: linear-gradient(135deg, #d6b3ff, #f7b9f4); border: none; color: #3b1c47; font-weight: 600; border-radius: 8px;">
                        Submit Review
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional Inline Styling -->
    <style>
        .review-card {
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .review-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
    </style>
@endsection
