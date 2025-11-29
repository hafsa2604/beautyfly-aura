@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="admin-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-info-circle me-2"></i>Category Details</h4>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">Back to List</a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9">{{ $category->id }}</dd>

                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9"><strong>{{ $category->name }}</strong></dd>

                        <dt class="col-sm-3">Slug:</dt>
                        <dd class="col-sm-9"><code>{{ $category->slug }}</code></dd>

                        <dt class="col-sm-3">Description:</dt>
                        <dd class="col-sm-9">{{ $category->description ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Products Count:</dt>
                        <dd class="col-sm-9"><span class="badge bg-info">{{ $category->products->count() }}</span></dd>

                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $category->created_at->format('M d, Y H:i') }}</dd>
                    </dl>

                    @if($category->products->count() > 0)
                        <hr>
                        <h5>Products in this Category:</h5>
                        <ul>
                            @foreach($category->products as $product)
                                <li><a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-purple">
                            <i class="bi bi-pencil-square me-2"></i>Edit Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

