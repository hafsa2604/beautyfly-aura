{{-- Form Actions Partial --}}
@php
    $cancelRoute = $cancelRoute ?? route('admin.products.index');
    $submitText = $submitText ?? 'Save';
    $submitIcon = $submitIcon ?? 'check-circle';
@endphp

<div class="d-flex justify-content-between pt-3 border-top">
    <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-purple">
        <i class="bi bi-{{ $submitIcon }} me-2"></i>{{ $submitText }}
    </button>
</div>

