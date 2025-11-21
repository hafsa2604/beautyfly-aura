@extends('layouts.layout')

@section('content')
    <!-- 🌸 Hero Section -->
    <section class="text-center py-5" style="background: linear-gradient(135deg, #e3c9ff, #f8d4ff); border-radius: 20px;">
        <div class="container">
            <h1 class="fw-bold display-5" style="color: #4B0082;">Welcome to <span style="color:#7a1fa2;">BeautyFly Aura</span> 🌸</h1>
            <p class="lead mt-3" style="color:#3b1c47; max-width: 600px; margin: 0 auto;">
                Discover premium skincare products designed to bring out your natural glow.
                BeautyFly Aura — where elegance meets self-care.
            </p>
            <div class="mt-4 d-flex justify-content-center gap-3">
                <a href="{{ route('products') }}" class="btn btn-lg" style="background-color: #7a1fa2; color: white; border-radius: 30px; padding: 10px 30px;">Shop Now</a>
                <a href="{{ route('skin-type') }}" class="btn btn-lg btn-outline-light" style="color:#7a1fa2; border-color:#7a1fa2; border-radius:30px; padding:10px 30px;">Know Your Skin Type</a>
            </div>
        </div>
    </section>

    <!-- 💜 Best Sellers -->
    <section class="mt-5 text-center">
        <h2 class="fw-bold mb-4" style="color: #4B0082;">💜 Our Best Sellers 💜</h2>

        <div class="row justify-content-center">
            @forelse($bestSellers as $product)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 20px;">
                        <img src="{{ $product->image ? asset('images/'.$product->image) : asset('images/placeholder.jpg') }}" 
                             class="card-img-top" 
                             alt="{{ $product->title }}" 
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                             style="border-top-left-radius: 20px; border-top-right-radius: 20px; height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold" style="color: #4B0082;">{{ $product->title }}</h5>
                            <p class="card-text" style="color: #3b1c47;">
                                {{ Str::limit($product->desc, 80) }}
                            </p>
                            <p class="fw-bold text-success mb-2">PKR {{ number_format($product->price) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" 
                               class="btn btn-outline-primary" 
                               style="color: #7a1fa2; border-color: #7a1fa2;">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No products available yet. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- 💎 Why Choose Us -->
    <section class="py-5 mt-5" style="background: #f8e6ff; border-radius: 20px;">
        <div class="container text-center">
            <h2 class="fw-bold mb-4" style="color:#4B0082;">💎 Why Choose BeautyFly Aura?</h2>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <i class="bi bi-stars fs-2 text-purple"></i>
                    <h5 class="mt-3 text-purple">Premium Quality</h5>
                    <p>Carefully formulated with safe and natural ingredients.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-heart fs-2 text-purple"></i>
                    <h5 class="mt-3 text-purple">Cruelty-Free</h5>
                    <p>Ethically crafted — no animal testing, ever.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-truck fs-2 text-purple"></i>
                    <h5 class="mt-3 text-purple">Fast Delivery</h5>
                    <p>Your favorite skincare delivered to your doorstep.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

