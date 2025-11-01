@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4 fw-bold">✨ Our Skincare Products ✨</h1>

        <div class="text-center mb-4">
            <label for="skinFilter" class="form-label fw-bold">Filter by Skin Type:</label>
            <select id="skinFilter" class="form-select w-auto d-inline-block">
                <option value="all">All</option>
                <option value="dry">Dry Skin</option>
                <option value="oily">Oily Skin</option>
                <option value="combination">Combination Skin</option>
            </select>
        </div>

        <div class="row" id="productList">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4 product-card" data-type="{{ $product['type'] }}">
                    <!-- Make card clickable -->
                    <div class="card shadow-sm border-0 h-100 product-link"
                         onclick="window.location='{{ route('product.show', $product['id']) }}'"
                         style="cursor:pointer; transition: transform 0.2s ease;">

                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['title'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $product['title'] }}</h5>
                            <p class="card-text small text-muted">{{ $product['desc'] }}</p>
                            <p class="fw-bold text-dark mb-2">Rs {{ $product['price'] }}</p>

                            <!-- Add to Cart Button -->
                            <form action="{{ route('cart.add', $product['id']) }}" method="POST"
                                  onclick="event.stopPropagation();">
                                @csrf
                                <button class="btn btn-success px-3">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Filter by skin type
        document.getElementById('skinFilter').addEventListener('change', function() {
            const selected = this.value;
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.display = (selected === 'all' || card.dataset.type === selected) ? 'block' : 'none';
            });
        });
    </script>

    <style>
        /* Small hover effect for a premium touch 💜 */
        .product-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(75, 0, 130, 0.15);
        }
    </style>
@endsection
