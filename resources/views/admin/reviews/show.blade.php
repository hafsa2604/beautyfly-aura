@extends('admin.layouts.app')

@section('title', 'Review Details')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Review Details</h4>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-light btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9">{{ $review->id }}</dd>

                        <dt class="col-sm-3">Product:</dt>
                        <dd class="col-sm-9">
                            @if($review->product)
                                <a href="{{ route('admin.products.edit', $review->product->id) }}">{{ $review->product->title }}</a>
                            @else
                                <span class="text-muted">Product Deleted (ID: {{ $review->product_id }})</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Reviewer Name:</dt>
                        <dd class="col-sm-9"><strong>{{ $review->name }}</strong></dd>

                        @if($review->user)
                        <dt class="col-sm-3">User Account:</dt>
                        <dd class="col-sm-9">{{ $review->user->email }}</dd>
                        @endif

                        <dt class="col-sm-3">Rating:</dt>
                        <dd class="col-sm-9">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                            @endfor
                            ({{ $review->rating }}/5)
                        </dd>

                        <dt class="col-sm-3">Review:</dt>
                        <dd class="col-sm-9">
                            <p>{{ $review->review }}</p>
                            @if($review->image)
                                <div class="mt-2">
                                    <img src="{{ asset('images/reviews/' . $review->image) }}" alt="Review Image" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                </div>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Date:</dt>
                        <dd class="col-sm-9">{{ $review->created_at->format('M d, Y H:i') }}</dd>
                    </dl>

                    <div class="mt-4">
                        <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-primary me-2">Edit Review</a>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

