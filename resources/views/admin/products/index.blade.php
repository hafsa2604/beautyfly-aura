@extends('admin.layouts.app')

@section('title', 'Products Management')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products Management</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image && file_exists(public_path('images/'.$product->image)))
                                    <img src="{{ asset('images/'.$product->image) }}" 
                                         alt="{{ $product->title }}" 
                                         onerror="this.parentElement.innerHTML='<span class=\'text-muted\'>No image</span>';"
                                         style="height:50px; width:50px; object-fit:cover; border-radius:4px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($product->type ?? 'N/A') }}</span>
                            </td>
                            <td><strong>PKR {{ number_format($product->price, 2) }}</strong></td>
                            <td>{{ $product->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" 
                                          method="POST" 
                                          style="display:inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <p class="mb-0">No products found. <a href="{{ route('admin.products.create') }}">Create your first product</a></p>
        </div>
    @endif
</div>
@endsection
