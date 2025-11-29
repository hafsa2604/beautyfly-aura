{{-- Product Form Fields Partial --}}
@php
    $isEdit = isset($product);
    $product = $product ?? null;
@endphp

<div class="mb-4">
    <label for="title" class="form-label fw-semibold">Product Title <span class="text-danger">*</span></label>
    <input type="text" 
           class="form-control @error('title') is-invalid @enderror" 
           id="title" 
           name="title" 
           value="{{ old('title', $product->title ?? '') }}" 
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="category_id" class="form-label fw-semibold">Category (Skin Type) <span class="text-danger">*</span></label>
    <select class="form-select @error('category_id') is-invalid @enderror" 
            id="category_id" 
            name="category_id" 
            required>
        <option value="">Select category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="price" class="form-label fw-semibold">Price (PKR) <span class="text-danger">*</span></label>
    <input type="number" 
           class="form-control @error('price') is-invalid @enderror" 
           id="price" 
           name="price" 
           step="0.01" 
           min="0" 
           value="{{ old('price', $product->price ?? '') }}" 
           required>
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="image" class="form-label fw-semibold">Product Image</label>
    @if($isEdit && $product->image && file_exists(public_path('images/'.$product->image)))
        <div class="mb-3 p-3 bg-light rounded">
            <img src="{{ asset('images/'.$product->image) }}" 
                 alt="{{ $product->title }}" 
                 onerror="this.parentElement.innerHTML='<p class=\'text-muted small\'>Image not found</p>';"
                 style="max-height:150px; border-radius:8px; border:2px solid #E5E7EB;">
            <p class="text-muted small mt-2 mb-0">Current image</p>
        </div>
    @elseif($isEdit && $product->image)
        <div class="mb-2">
            <p class="text-warning small">Image file not found: {{ $product->image }}</p>
        </div>
    @endif
    <input type="file" 
           class="form-control @error('image') is-invalid @enderror" 
           id="image" 
           name="image" 
           accept="image/jpeg,image/png,image/jpg">
    <small class="form-text text-muted">
        @if($isEdit)
            Leave empty to keep current image. 
        @endif
        Accepted formats: JPG, PNG, JPEG. Max size: 2MB
    </small>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="desc" class="form-label fw-semibold">Description</label>
    <textarea class="form-control @error('desc') is-invalid @enderror" 
              id="desc" 
              name="desc" 
              rows="4">{{ old('desc', $product->desc ?? '') }}</textarea>
    @error('desc')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="benefits" class="form-label fw-semibold">Benefits</label>
    <textarea class="form-control @error('benefits') is-invalid @enderror" 
              id="benefits" 
              name="benefits" 
              rows="3">{{ old('benefits', $product->benefits ?? '') }}</textarea>
    @error('benefits')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="usage" class="form-label fw-semibold">Usage Instructions</label>
    <textarea class="form-control @error('usage') is-invalid @enderror" 
              id="usage" 
              name="usage" 
              rows="3">{{ old('usage', $product->usage ?? '') }}</textarea>
    @error('usage')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

