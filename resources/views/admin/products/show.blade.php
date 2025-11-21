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
            <img src="{{ asset('images/' . $product->image) }}" alt="" style="max-width:200px;" class="rounded shadow">

            <div class="mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
