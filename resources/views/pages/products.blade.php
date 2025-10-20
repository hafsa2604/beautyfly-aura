
@extends('layouts.layout')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Products</h2>
    <form class="d-flex" method="GET" action="{{ route('products') }}">
      <input name="search" class="form-control me-2" placeholder="Search" value="{{ $request->search ?? '' }}">
      <select name="skin_type" class="form-select me-2">
        <option value="All">All</option>
        <option value="Dry" {{ (isset($request->skin_type) && $request->skin_type=='Dry')?'selected':'' }}>Dry</option>
        <option value="Oily" {{ (isset($request->skin_type) && $request->skin_type=='Oily')?'selected':'' }}>Oily</option>
        <option value="Combination" {{ (isset($request->skin_type) && $request->skin_type=='Combination')?'selected':'' }}>Combination</option>
      </select>
      <button class="btn btn-outline-primary">Filter</button>
    </form>
  </div>

  <div class="row">
    @forelse($products as $product)
      @include('partials.product-card', ['product' => $product])
    @empty
      <p>No products found.</p>
    @endforelse
  </div>
@endsection
