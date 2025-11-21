@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Product Details</h2>

        <div class="card p-4 shadow-sm">
            <h4>{{ $product->title }}</h4>

            <p><strong>Skin Type:</strong> {{ ucfirst($product->type) }}</p>
            <p><strong>Price:</strong> PKR {{ number_format($product->price) }}</p>
            <p><strong>Description:</strong> {{ $product->desc }}</p>
            <p><strong>Benefits:</strong> {{ $product->benefits }}</p>
            <p><strong>Usage:</strong> {{ $product->usage }}</p>

            <p><strong>Image:</strong></p>
            @if($product->image && file_exists(public_path('images/'.$product->image)))
                <img src="{{ asset('images/' . $product->image) }}" 
                     alt="{{ $product->title }}" 
                     onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;"
                     style="max-width:200px;" 
                     class="rounded shadow">
            @else
                <p class="text-muted">No image available</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
