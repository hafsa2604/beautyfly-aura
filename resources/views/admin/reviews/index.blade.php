@extends('admin.layouts.app')

@section('title', 'Reviews Management')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Reviews Management</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($reviews->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Reviewer</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>
                                @if($review->product)
                                    <a href="{{ route('admin.products.edit', $review->product->id) }}">{{ $review->product->title }}</a>
                                @else
                                    <span class="text-muted">Product Deleted (ID: {{ $review->product_id }})</span>
                                @endif
                            </td>
                            <td>{{ $review->name }} @if($review->user)({{ $review->user->email }})@endif</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill text-warning' : '' }}"></i>
                                @endfor
                            </td>
                            <td>
                                {{ Str::limit($review->review, 50) }}
                                @if($review->image)
                                    <br>
                                    <small class="text-muted"><i class="bi bi-image"></i> Image attached</small>
                                @endif
                            </td>
                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.reviews.show', $review) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline"
                                          onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf @method('DELETE')
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
            {{ $reviews->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <p class="mb-0">No reviews found.</p>
        </div>
    @endif
</div>
@endsection

