
@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-md-6">
    <h2>Contact Us</h2>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('contact.send') }}" method="POST">
      @csrf
      <div class="mb-2"><input class="form-control" name="name" placeholder="Your name" required></div>
      <div class="mb-2"><input class="form-control" name="email" type="email" placeholder="Your email" required></div>
      <div class="mb-2"><textarea class="form-control" name="message" placeholder="Message" rows="4" required></textarea></div>
      <button class="btn btn-primary">Send</button>
    </form>
  </div>

  <div class="col-md-6">
    <h2>Know Your Skin Type</h2>
    <p><strong>Dry:</strong> skin feels tight, rough or flaky after washing.</p>
    <p><strong>Oily:</strong> skin looks shiny, large pores, prone to acne.</p>
    <p><strong>Combination:</strong> oily in T-zone (forehead, nose, chin) and dry on cheeks.</p>
  </div>
</div>
@endsection
