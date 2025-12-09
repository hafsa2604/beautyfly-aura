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
            <form method="GET" action="{{ route('products') }}" class="row g-3" id="filterForm">

            <!-- Skin Type Filter -->
            <div class="col-md-3">
                <select name="type" class="form-select" id="categoryFilter">
                    <option value="all" {{ $selectedType=='all' ? 'selected' : '' }}>All Skin Types</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ $selectedType==$category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ajax Search Bar -->
            <div class="col-md-5 position-relative">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" 
                           id="searchInput" 
                           class="form-control search-input" 
                           placeholder="Search products by name or category..." 
                           autocomplete="off"
                           value="{{ $searchTerm }}">
                    <div id="searchResults" class="search-results-dropdown"></div>
                </div>
            </div>

            <!-- Sort -->
            <div class="col-md-3">
                <select name="sort" class="form-select" id="sortFilter">
                    <option value="">Default Sorting</option>
                    <option value="newest" {{ $selectedSort=='newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_asc" {{ $selectedSort=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ $selectedSort=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
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

        /* Search Bar Styles */
        .filters-section {
            position: relative;
            z-index: 1000;
            overflow: visible;
        }

        .search-container {
            position: relative;
            width: 100%;
            overflow: visible;
            z-index: 100000;
        }

        .search-input {
            padding-left: 45px;
            padding-right: 15px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
            width: 100%;
        }

        .search-input:focus {
            border-color: #4B0082;
            box-shadow: 0 0 0 0.2rem rgba(75, 0, 130, 0.25);
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
            font-size: 18px;
            z-index: 10;
        }

        .search-results-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            width: 100%;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-height: 450px;
            overflow-y: auto;
            z-index: 99999;
            padding: 8px 0;
        }

        .search-results-list {
            padding: 0;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            text-decoration: none;
            color: inherit;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
            width: 100%;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .search-result-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 12px;
            flex-shrink: 0;
            background: #f5f5f5;
        }

        .search-result-info {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .search-result-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
            font-size: 15px;
            line-height: 1.4;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .search-result-category {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .search-loading,
        .search-error,
        .search-no-results {
            padding: 20px;
            text-align: center;
            color: #6c757d;
        }

        .search-loading i {
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Product card click functionality
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

            // Ajax Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            let searchTimeout;
            let currentRequest = null;

            if (!searchInput || !searchResults) return;

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-container')) {
                    searchResults.style.display = 'none';
                }
            });

            // Handle search input keyup event
            searchInput.addEventListener('keyup', function(e) {
                const query = this.value.trim();

                // Cancel previous request if still pending
                if (currentRequest) {
                    currentRequest.abort();
                }

                // Clear previous timeout
                clearTimeout(searchTimeout);

                // Hide results if query is empty
                if (query.length === 0) {
                    searchResults.style.display = 'none';
                    searchResults.innerHTML = '';
                    return;
                }

                // Debounce: wait 300ms after user stops typing
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            });

            function performSearch(query) {
                // Show loading state
                searchResults.innerHTML = '<div class="search-loading"><i class="bi bi-arrow-repeat"></i> Searching...</div>';
                searchResults.style.display = 'block';

                // Create new XMLHttpRequest
                currentRequest = new XMLHttpRequest();
                const url = '/search-products?search=' + encodeURIComponent(query);
                currentRequest.open('GET', url, true);
                
                currentRequest.onload = function() {
                    if (this.status === 200) {
                        try {
                            const data = JSON.parse(this.responseText);
                            displayResults(data.products);
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            searchResults.innerHTML = '<div class="search-error">Error loading results</div>';
                        }
                    } else {
                        searchResults.innerHTML = '<div class="search-error">Error loading results</div>';
                    }
                    currentRequest = null;
                };

                currentRequest.onerror = function() {
                    searchResults.innerHTML = '<div class="search-error">Network error</div>';
                    currentRequest = null;
                };

                currentRequest.send();
            }

            function displayResults(products) {
                if (products.length === 0) {
                    searchResults.innerHTML = '<div class="search-no-results">No products found</div>';
                    searchResults.style.display = 'block';
                    return;
                }

                let html = '<div class="search-results-list">';
                products.forEach(product => {
                    html += `
                        <a href="${product.url}" class="search-result-item">
                            <img src="${product.image}" alt="${escapeHtml(product.title)}" class="search-result-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <div class="search-result-info">
                                <div class="search-result-title">${escapeHtml(product.title)}</div>
                                <div class="search-result-category">${escapeHtml(product.category)}</div>
                            </div>
                        </a>
                    `;
                });
                html += '</div>';
                searchResults.innerHTML = html;
                searchResults.style.display = 'block';
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
        });
    </script>
@endsection
