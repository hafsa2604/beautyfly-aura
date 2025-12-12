@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #7a1fa2;">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}" style="color: #7a1fa2;">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->title }}</li>
            </ol>
        </nav>

        <div class="row align-items-start">
            <!-- Product Image -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <div class="product-image-wrapper">
                    <img src="{{ $product->image ? asset('images/' . $product->image) : asset('images/placeholder.jpg') }}"
                         alt="{{ $product->title }}"
                         class="img-fluid rounded shadow-lg product-main-image"
                         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                         style="max-height: 500px; object-fit: cover; border-radius: 15px;">
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="fw-bold mb-3" style="color:#4B0082;">{{ $product->title }}</h1>
                    
                    <div class="product-meta mb-4">
                        <span class="badge-purple me-2">
                            <i class="bi bi-tag me-1"></i>{{ $product->category ? $product->category->name : 'N/A' }}
                        </span>
                        <span class="text-muted">
                            <i class="bi bi-star-fill text-warning"></i> 4.8 (120+ reviews)
                        </span>
                    </div>

                    <div class="product-price mb-4">
                        <h3 class="fw-bold mb-0" style="color:#4B0082; font-size: 2.5rem;">
                            PKR {{ number_format($product->price) }}
                        </h3>
                        <small class="text-muted">Inclusive of all taxes</small>
                    </div>

                    <div class="product-description mb-4">
                        <h5 class="fw-semibold mb-3" style="color:#4B0082;">
                            <i class="bi bi-info-circle me-2"></i>Description
                        </h5>
                        <p class="text-muted">{{ $product->desc }}</p>
                    </div>

                    <div class="product-benefits mb-4">
                        <h5 class="fw-semibold mb-3" style="color:#4B0082;">
                            <i class="bi bi-check-circle me-2"></i>Key Benefits
                        </h5>
                        <p class="text-muted">{{ $product->benefits }}</p>
                    </div>

                    <div class="product-usage mb-4">
                        <h5 class="fw-semibold mb-3" style="color:#4B0082;">
                            <i class="bi bi-book me-2"></i>How to Use
                        </h5>
                        <p class="text-muted">{{ $product->usage }}</p>
                    </div>

                    <!-- Add to Cart -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                        @csrf
                        <button class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                        </button>
                    </form>

                    <!-- Highlights -->
                    <div class="product-highlights">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="highlight-item">
                                    <i class="bi bi-shield-check text-success"></i>
                                    <span>100% Dermatologically Tested</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="highlight-item">
                                    <i class="bi bi-heart text-danger"></i>
                                    <span>Cruelty-Free and Vegan</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="highlight-item">
                                    <i class="bi bi-truck text-primary"></i>
                                    <span>Free Delivery on Orders Over PKR 2000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Reviews Section -->
        <div class="reviews-section mt-5">
            <div class="section-header mb-4">
                <h3 class="fw-bold mb-2" style="color:#4B0082;">
                    <i class="bi bi-star-fill me-2" style="color: #f7b9f4;"></i>Customer Reviews
                </h3>
                <p class="text-muted">See what our customers are saying</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @forelse($reviews as $r)
                <div class="review-card p-4 mb-3 rounded shadow-sm bg-white border-0">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <strong style="color:#4B0082; font-size: 1.1rem;">{{ $r->name }}</strong>
                            @if($r->user)
                                <small class="text-muted d-block">Verified Purchase</small>
                            @endif
                        </div>
                        <div class="text-end">
                            <div class="mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $r->rating ? '-fill text-warning' : '' }}"></i>
                                @endfor
                            </div>
                            <small class="text-muted">{{ $r->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                    <p class="mb-0" style="color:#3b1c47; line-height: 1.6;">{{ $r->review }}</p>
                    @if($r->image)
                        <div class="mt-3">
                            <img src="{{ asset('images/reviews/' . $r->image) }}" alt="Review Image" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-chat-quote" style="font-size: 3rem; color: #f7b9f4;"></i>
                    <p class="text-muted mt-3">No reviews yet — be the first to share your experience 💜</p>
                </div>
            @endforelse

            <!-- Add Review Form -->
            <div class="mt-5 p-4 rounded shadow-sm review-form-section">
                <h5 class="fw-bold mb-3" style="color:#4B0082;">
                    <i class="bi bi-pencil-square me-2"></i>Write a Review
                </h5>
                <form method="POST" action="{{ route('product.review', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control border-0 shadow-sm" placeholder="Your name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select border-0 shadow-sm" required>
                            <option value="5">5 Stars - Excellent</option>
                            <option value="4">4 Stars - Very Good</option>
                            <option value="3">3 Stars - Good</option>
                            <option value="2">2 Stars - Fair</option>
                            <option value="1">1 Star - Poor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea name="review" class="form-control border-0 shadow-sm" placeholder="Write your review..." rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small">Add a photo (optional)</label>
                        <input type="file" name="image" class="form-control border-0 shadow-sm" id="reviewImageInput" accept="image/*">
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 150px;">
                        </div>
                    </div>

                    <button class="btn px-4 py-2" style="background:linear-gradient(135deg,#d6b3ff,#f7b9f4); border:none; color:#3b1c47; font-weight:600; border-radius:8px;">
                        Submit Review
                    </button>
                </form>

                <script>
                    document.getElementById('reviewImageInput').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            // Validate file size (2MB)
                            if (file.size > 2 * 1024 * 1024) {
                                alert('File size must be less than 2MB');
                                this.value = '';
                                return;
                            }
                            
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = document.getElementById('imagePreview');
                                const img = preview.querySelector('img');
                                img.src = e.target.result;
                                preview.style.display = 'block';
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <style>
        .review-card { transition: transform .2s, box-shadow .2s; }
        .review-card:hover { transform: translateY(-3px); box-shadow:0 6px 15px rgba(0,0,0,0.1); }
    </style>
@endsection
