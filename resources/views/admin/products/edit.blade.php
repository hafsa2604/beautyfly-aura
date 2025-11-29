@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
@include('admin.products.form', ['product' => $product])
@endsection
