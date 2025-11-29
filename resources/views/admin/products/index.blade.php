@extends('admin.layouts.app')

@section('title', 'Products Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1" style="color: var(--purple-dark); font-weight: 600;">Products</h2>
        <p class="text-muted mb-0">Manage your product catalog</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-purple">
        <i class="bi bi-plus-circle me-2"></i> Add New Product
    </a>
</div>

@if($products->count() > 0)
    <div class="admin-table">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="product-row-clickable" data-href="{{ route('admin.products.edit', $product) }}" style="cursor: pointer;">
                            <td class="clickable-cell"><strong>#{{ $product->id }}</strong></td>
                            <td class="clickable-cell">
                                @if($product->image && file_exists(public_path('images/'.$product->image)))
                                    <img src="{{ asset('images/'.$product->image) }}" 
                                         alt="{{ $product->title }}" 
                                         onerror="this.parentElement.innerHTML='<span class=\'text-muted\'>No image</span>';"
                                         style="height:50px; width:50px; object-fit:cover; border-radius:8px; border: 2px solid #E5E7EB;">
                                @else
                                    <div style="height:50px; width:50px; background:#F3F4F6; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="clickable-cell"><strong>{{ $product->title }}</strong></td>
                            <td class="clickable-cell">
                                <span class="badge-purple">{{ $product->category ? $product->category->name : 'N/A' }}</span>
                            </td>
                            <td class="clickable-cell"><strong style="color: var(--purple-primary);">PKR {{ number_format($product->price, 2) }}</strong></td>
                            <td class="clickable-cell">{{ $product->created_at->format('M d, Y') }}</td>
                            <td class="actions-cell" onclick="event.stopPropagation();">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-sm btn-outline-purple">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" 
                                          method="POST" 
                                          style="display:inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@else
    <div class="admin-card">
        <div class="card-body text-center py-5">
            <i class="bi bi-box-seam" style="font-size: 4rem; color: var(--purple-lighter);"></i>
            <h4 class="mt-3 mb-2" style="color: var(--purple-dark);">No products found</h4>
            <p class="text-muted mb-4">Get started by creating your first product</p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-purple">
                <i class="bi bi-plus-circle me-2"></i> Create Product
            </a>
        </div>
    </div>
@endif

<style>
    .product-row-clickable {
        transition: background-color 0.2s ease;
    }
    
    .product-row-clickable:hover {
        background-color: rgba(122, 31, 162, 0.05) !important;
    }
    
    .clickable-cell {
        cursor: pointer;
    }
    
    .actions-cell {
        cursor: default;
    }
    
    .actions-cell:hover {
        background-color: transparent !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.product-row-clickable');
        rows.forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't navigate if clicking on actions column or buttons
                if (e.target.closest('.actions-cell') || e.target.closest('button') || e.target.closest('form')) {
                    return;
                }
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
@endsection
