@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">User Details</h4>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9">{{ $user->id }}</dd>

                        <dt class="col-sm-3">Name:</dt>
                        <dd class="col-sm-9"><strong>{{ $user->name }}</strong></dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>

                        <dt class="col-sm-3">Admin:</dt>
                        <dd class="col-sm-9">
                            @if($user->is_admin)
                                <span class="badge bg-danger">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Orders:</dt>
                        <dd class="col-sm-9"><span class="badge bg-info">{{ $user->orders->count() }}</span></dd>

                        <dt class="col-sm-3">Reviews:</dt>
                        <dd class="col-sm-9"><span class="badge bg-info">{{ $user->reviews->count() }}</span></dd>

                        <dt class="col-sm-3">Created:</dt>
                        <dd class="col-sm-9">{{ $user->created_at->format('M d, Y H:i') }}</dd>
                    </dl>

                    @if($user->orders->count() > 0)
                        <hr>
                        <h5>Orders</h5>
                        <ul>
                            @foreach($user->orders as $order)
                                <li><a href="{{ route('admin.orders.show', $order) }}">Order #{{ $order->order_number }}</a> - PKR {{ number_format($order->total_amount, 2) }} ({{ $order->status }})</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

