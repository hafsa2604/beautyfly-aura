{{-- Unified Category Form (used by both create and edit) --}}
@php
    $isEdit = isset($category);
    $category = $category ?? null;
    $formAction = $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
    $headerIcon = $isEdit ? 'pencil-square' : 'plus-circle';
    $headerText = $isEdit ? 'Edit Category' : 'Add New Category';
    $submitText = $isEdit ? 'Update Category' : 'Save Category';
@endphp

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="admin-card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-{{ $headerIcon }} me-2"></i>{{ $headerText }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    @include('admin.partials.category-form')

                    @include('admin.partials.form-actions', [
                        'cancelRoute' => route('admin.categories.index'),
                        'submitText' => $submitText
                    ])
                </form>
            </div>
        </div>
    </div>
</div>

