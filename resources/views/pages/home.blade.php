@extends('layouts.layout')

@section('content')
    <!-- 🌸 Hero Section -->
    <section class="hero-section-enhanced text-center">
        <div class="container position-relative">
            <h1 class="fw-bold display-4 mb-4" style="color: #4B0082;">
                Welcome to <span style="color:#7a1fa2;">BeautyFly Aura</span> 
                <span style="font-size: 2.5rem;">🌸</span>
            </h1>
            <p class="lead mt-3 mb-4" style="color:#3b1c47; max-width: 650px; margin: 0 auto; font-size: 1.25rem;">
                Discover premium skincare products designed to bring out your natural glow.
                BeautyFly Aura — where elegance meets self-care.
            </p>
            <div class="mt-5 d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-bag me-2"></i>Shop Now
                </a>
                <a href="{{ route('skin-type') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-heart-pulse me-2"></i>Know Your Skin Type
                </a>
            </div>
        </div>
    </section>

    <!-- 💜 Best Sellers -->
    <section class="mt-5 text-center">
        <div class="mb-5">
            <h2 class="fw-bold mb-3" style="color: #4B0082;">
                <i class="bi bi-star-fill me-2" style="color: #f7b9f4;"></i>Our Best Sellers
            </h2>
            <p class="text-muted">Handpicked favorites loved by our customers</p>
        </div>

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
    <section class="py-5 mt-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5" style="color:#4B0082;">
                <i class="bi bi-gem me-2"></i>Why Choose BeautyFly Aura?
            </h2>
            <div class="row justify-content-center g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <i class="bi bi-stars"></i>
                        <h5 class="mt-3" style="color:#4B0082;">Premium Quality</h5>
                        <p class="text-muted">Carefully formulated with safe and natural ingredients.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <i class="bi bi-heart"></i>
                        <h5 class="mt-3" style="color:#4B0082;">Cruelty-Free</h5>
                        <p class="text-muted">Ethically crafted — no animal testing, ever.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <i class="bi bi-truck"></i>
                        <h5 class="mt-3" style="color:#4B0082;">Fast Delivery</h5>
                        <p class="text-muted">Your favorite skincare delivered to your doorstep.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <i class="bi bi-shield-check"></i>
                        <h5 class="mt-3" style="color:#4B0082;">Dermatologist Tested</h5>
                        <p class="text-muted">All products tested and approved by skincare experts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

