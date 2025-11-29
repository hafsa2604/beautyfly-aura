@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3" style="color: #4B0082;">
                <i class="bi bi-box-seam me-2" style="color: #f7b9f4;"></i>Our Skincare Products
            </h1>
            <p class="text-muted">Discover our premium collection of skincare essentials</p>
        </div>

        <!-- Filters -->
        <div class="filters-section mb-5">
            <form method="GET" action="{{ route('products') }}" class="row g-3">

            <!-- Skin Type Filter -->
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="all" {{ $selectedType=='all' ? 'selected' : '' }}>All Skin Types</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ $selectedType==$category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search -->
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Search products..."
                       value="{{ $searchTerm }}">
            </div>

            <!-- Sort -->
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="">Default Sorting</option>
                    <option value="newest" {{ $selectedSort=='newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_asc" {{ $selectedSort=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ $selectedSort=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <div class="col-md-1">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card product-card shadow-sm h-100 fade-in-up product-card-clickable" 
                         data-href="{{ route('product.show', $product->id) }}"
                         style="cursor: pointer; transition: all 0.3s ease;">

                        <img src="{{ $product->image ? asset('images/'.$product->image) : asset('images/placeholder.jpg') }}"
                             class="card-img-top"
                             alt="{{ $product->title }}"
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $product->title }}</h5>

                            <p class="text-muted mb-1">{{ $product->category ? $product->category->name : 'N/A' }}</p>

                            <p class="fw-bold text-success">
                                PKR {{ number_format($product->price) }}
                            </p>

                            <a href="{{ route('product.show', $product->id) }}"
                               class="btn btn-outline-primary w-100 mt-2"
                               onclick="event.stopPropagation();">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <p class="text-center mt-4">No products found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    </div>

    <style>
        .product-card-clickable:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(122, 31, 162, 0.2) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.product-card-clickable');
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't navigate if clicking on the button
                    if (e.target.closest('a.btn') || e.target.closest('button')) {
                        return;
                    }
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
@endsection
