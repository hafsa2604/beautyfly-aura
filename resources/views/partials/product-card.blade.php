
<div class="col-md-4 mb-4">
  <div class="card h-100">
    <img src="{{ !empty($product['image']) ? asset('images/' . $product['image']) : asset('images/placeholder.jpg') }}" 
         class="card-img-top" 
         alt="{{ $product['title'] }}" 
         onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
         style="height:220px;object-fit:cover;">
    <div class="card-body d-flex flex-column">
      <h5 class="card-title">{{ $product['title'] }}</h5>
      <p class="card-text">{{ $product['short'] ?? '' }}</p>
      <p class="mt-auto"><strong>PKR {{ $product['price'] }}</strong></p>
      <div class="d-flex gap-2">
        <form action="{{ route('cart.add', $product['id']) }}" method="POST">@csrf<button class="btn btn-sm btn-success">Add to Cart</button></form>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('product.show', $product['id']) }}">View</a>
      </div>
    </div>
  </div>
</div>
