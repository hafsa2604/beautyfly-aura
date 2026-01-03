@extends('layouts.layout')

@section('content')
    <!-- Hero Section with Gradient Background -->
    <div class="hero-gradient-section py-5 mb-5">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="fw-bold mb-3 display-5" style="color: #4B0082;">
                    <i class="bi bi-box-seam me-2"></i>Our Skincare Products
                </h1>
                <p class="lead" style="color: #5a3e75;">Discover our premium collection of skincare essentials</p>
            </div>

            <!-- Floating Filter Bar -->
            <div class="filter-card bg-white rounded-pill shadow-lg p-3 mx-auto" style="max-width: 950px;">
                <form method="GET" action="{{ route('products') }}" class="row g-2 align-items-center">
                    <!-- Category Filter -->
                    <div class="col-md-3">
                        <select name="type" class="form-select border-0 bg-light rounded-pill" onchange="this.form.submit()">
                            <option value="all" {{ $selectedType == 'all' ? 'selected' : '' }}>All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ $selectedType == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-md-6 position-relative">
                        <div class="input-group border-start border-end px-3">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-0 shadow-none" 
                                   placeholder="Search products..." 
                                   value="{{ $searchTerm }}"
                                   id="searchInput">
                            
                            <!-- Search Dropdown Results -->
                            <div class="search-results-dropdown" id="searchResults" style="display: none;">
                                <div class="search-loading" id="searchLoading" style="display: none;">
                                    <i class="bi bi-arrow-repeat spin"></i> Searching...
                                </div>
                                <div id="searchResultsContent"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Sort & Refresh Button -->
                    <div class="col-md-3 d-flex gap-2">
                        <select name="sort" class="form-select border-0 bg-light rounded-pill" onchange="this.form.submit()">
                            <option value="newest" {{ $selectedSort == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_asc" {{ $selectedSort == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ $selectedSort == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        
                        <button type="submit" class="btn btn-purple rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                                style="background-color: #9c27b0; color: white; width: 42px; height: 42px; min-width: 42px;">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card product-card shadow-sm h-100 fade-in-up product-card-clickable" 
                         onclick="window.location.href='{{ route('product.show', $product->id) }}'"
                         style="cursor: pointer; transition: all 0.3s ease;">

                        <img src="{{ $product->image ? asset('images/' . $product->image) : asset('images/placeholder.jpg') }}"
                             class="card-img-top"
                             alt="{{ $product->title }}"
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $product->title }}</h5>

                            <p class="text-muted mb-1">{{ $product->category->name ?? 'N/A' }}</p>

                            <p class="fw-bold text-success">PKR {{ number_format($product->price) }}</p>

                            <a href="{{ route('product.show', $product->id) }}" 
                               class="btn btn-outline-primary w-100 mt-2"
                               onclick="event.stopPropagation()">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No products found.</h4>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // AJAX Search functionality
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsContent = document.getElementById('searchResultsContent');
        const searchLoading = document.getElementById('searchLoading');

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            searchLoading.style.display = 'block';
            searchResults.style.display = 'block';
            searchResultsContent.innerHTML = '';

            searchTimeout = setTimeout(() => {
                axios.get('{{ route("products.search") }}', {
                    params: { search: query }
                })
                .then(response => {
                    searchLoading.style.display = 'none';
                    const products = response.data.products;

                    if (products.length === 0) {
                        searchResultsContent.innerHTML = '<div class="p-3 text-center text-muted">No products found</div>';
                        return;
                    }

                    let html = '';
                    products.forEach(product => {
                        html += `
                            <div class="search-result-item" onclick="window.location.href='${product.url}'">
                                <img src="${product.image}" class="search-result-image" alt="${product.title}">
                                <div class="search-result-info">
                                    <div class="search-result-title">${product.title}</div>
                                    <div class="search-result-category">${product.category}</div>
                                </div>
                            </div>
                        `;
                    });
                    searchResultsContent.innerHTML = html;
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchLoading.style.display = 'none';
                    searchResultsContent.innerHTML = '<div class="p-3 text-center text-danger">Search failed</div>';
                });
            }, 500);
        });

        // Close search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.search-container')) {
                searchResults.style.display = 'none';
            }
        });
    </script>

    <style>
        .hero-gradient-section {
            background: linear-gradient(135deg, #e0c3fc 0%, #d8b5ff 100%);
            margin-left: -50vw;
            margin-right: -50vw;
            left: 50%;
            right: 50%;
            position: relative;
            width: 100vw;
        }
        
        .filter-card {
            transition: all 0.3s ease;
        }
        
        .product-card-clickable:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(122, 31, 162, 0.2) !important;
        }
        
        .search-results-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 5px;
        }
        
        .search-result-item {
            display: flex;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        
        .search-result-item:hover {
            background-color: #f8f9fa;
        }
        
        .search-result-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 10px;
            border-radius: 4px;
        }
        
        .search-loading {
            padding: 10px;
            text-align: center;
            color: #777;
        }
        
        .spin {
            animation: spin 1s infinite linear;
        }
        
        @keyframes spin { 
            100% { transform: rotate(360deg); } 
        }
    </style>
@endsection
