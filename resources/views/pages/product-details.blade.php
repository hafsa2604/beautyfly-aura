
@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-md-6">
    <img src="{{ asset('images/'.$product['image']) }}" class="img-fluid rounded" alt="{{ $product['title'] }}">
  </div>
  <div class="col-md-6">
    <h3>{{ $product['title'] }}</h3>
    <p>{{ $product['short'] ?? '' }}</p>
    <h4>PKR {{ $product['price'] }}</h4>

    <form action="{{ route('cart.add', $product['id']) }}" method="POST">
      @csrf
      <button class="btn btn-success">Add to Cart</button>
    </form>
  </div>
</div>

<hr>

<h4>Customer Reviews</h4>
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@forelse($reviews as $r)
  <div class="border rounded p-2 mb-2">
    <strong>{{ $r['name'] }}</strong><br>
    <small>{{ $r['review'] }}</small>
  </div>
@empty
  <p>No reviews yet. Be the first to review!</p>
@endforelse

<form method="POST" action="{{ route('product.review', $product['id']) }}">
  @csrf
  <div class="mb-2"><input name="name" class="form-control" placeholder="Your name" required></div>
  <div class="mb-2"><textarea name="review" class="form-control" placeholder="Write a review..." rows="3" required></textarea></div>
  <button class="btn btn-primary">Submit Review</button>
</form>
@endsection
