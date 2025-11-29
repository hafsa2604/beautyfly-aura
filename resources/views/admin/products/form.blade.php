{{-- Unified Product Form (used by both create and edit) --}}
@php
    $isEdit = isset($product);
    $product = $product ?? null;
    $formAction = $isEdit ? route('admin.products.update', $product) : route('admin.products.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
    $headerIcon = $isEdit ? 'pencil-square' : 'plus-circle';
    $headerText = $isEdit ? 'Edit Product' : 'Add New Product';
    $submitText = $isEdit ? 'Update Product' : 'Save Product';
@endphp

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="admin-card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-{{ $headerIcon }} me-2"></i>{{ $headerText }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    @include('admin.partials.product-form')

                    @include('admin.partials.form-actions', [
                        'cancelRoute' => route('admin.products.index'),
                        'submitText' => $submitText
                    ])
                </form>
            </div>
        </div>
    </div>
</div>

