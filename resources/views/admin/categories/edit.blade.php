@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
@include('admin.categories.form', ['category' => $category])
@endsection

