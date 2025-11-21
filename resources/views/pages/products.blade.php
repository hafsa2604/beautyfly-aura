@extends('layouts.layout')

@section('content')
    <div class="container py-4">

        <h1 class="text-center fw-bold mb-4">Our Skincare Products ✨</h1>

        <!-- Filters -->
        <form method="GET" action="{{ route('products') }}" class="row g-3 mb-4">

            <!-- Skin Type Filter -->
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="all" {{ $selectedType=='all' ? 'selected' : '' }}>All Skin Types</option>
                    <option value="dry" {{ $selectedType=='dry' ? 'selected' : '' }}>Dry Skin</option>
                    <option value="oily" {{ $selectedType=='oily' ? 'selected' : '' }}>Oily Skin</option>
                    <option value="combination" {{ $selectedType=='combination' ? 'selected' : '' }}>Combination Skin</option>
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
                <button class="btn btn-primary w-100">Go</button>
            </div>
        </form>

        <!-- Products Grid -->
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm h-100">

                        <img src="{{ $product->image ? asset('images/'.$product->image) : asset('images/placeholder.jpg') }}"
                             class="card-img-top"
                             alt="{{ $product->title }}"
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $product->title }}</h5>

                            <p class="text-muted mb-1">{{ ucfirst($product->type) }} skin</p>

                            <p class="fw-bold text-success">
                                PKR {{ number_format($product->price) }}
                            </p>

                            <a href="{{ route('product.show', $product->id) }}"
                               class="btn btn-outline-primary w-100 mt-2">
                                View Details
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
@endsection
