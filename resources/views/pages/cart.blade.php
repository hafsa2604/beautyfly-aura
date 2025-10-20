
@extends('layouts.layout')

@section('content')
<h2>Your Cart</h2>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@php $cart = $cart ?? session('cart', []); @endphp

@if(empty($cart))
  <p>Your cart is empty.</p>
@else
  <table class="table align-middle">
    <thead>
      <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th></th></tr>
    </thead>
    <tbody>
      @php $grand = 0; @endphp
      @foreach($cart as $id => $item)
        @php $total = $item['product']['price'] * $item['quantity']; $grand += $total; @endphp
        <tr>
          <td>{{ $item['product']['title'] }}</td>
          <td>
            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
              @csrf
              <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:60px;">
              <button class="btn btn-sm btn-secondary">Update</button>
            </form>
          </td>
          <td>{{ $item['product']['price'] }}</td>
          <td>{{ $total }}</td>
          <td>
            <form action="{{ route('cart.remove', $id) }}" method="POST">
              @csrf
              <button class="btn btn-sm btn-danger">Remove</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr><td colspan="3" class="text-end"><strong>Grand Total:</strong></td><td>{{ $grand }}</td><td></td></tr>
    </tfoot>
  </table>
@endif
@endsection
