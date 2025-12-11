@extends('admin.layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Review</h4>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-light btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Reviewer Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $review->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Review</label>
                            <textarea name="review" class="form-control @error('review') is-invalid @enderror" rows="5" required>{{ old('review', $review->review) }}</textarea>
                            @error('review')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Review Image</label>
                            @if($review->image)
                                <div class="mb-2">
                                    <img src="{{ asset('images/reviews/' . $review->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Leave empty to keep current image.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
