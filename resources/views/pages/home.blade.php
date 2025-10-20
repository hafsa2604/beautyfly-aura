@extends('layouts.layout')

@section('content')


    <!-- Hero Section -->
    <section class="hero-section text-center py-5">
        <div class="overlay">
            <h1 class="site-title">BeautyFly Aura</h1>
            <p class="lead">Discover your perfect skincare match — glow the way you deserve!</p>
            <a class="btn btn-primary mt-3" href="{{ route('products') }}">Browse Products</a>
        </div>
    </section>



    <!-- About Section -->
    <section class="container py-5 text-center">
        <h2 class="fw-semibold mb-3 text-primary">About BeautyFly Aura</h2>
        <p class="lead text-muted mb-4">
            At <strong>BeautyFly Aura</strong>, we believe every skin type deserves personalized care.
            Whether your skin is dry, oily, or combination, we provide tailored product recommendations
            to help you achieve a naturally radiant glow. Our mission is to simplify skincare —
            guiding you to products that truly work for you.
        </p>
    </section>

    <!-- Featured Products -->
    <section class="container py-5">
        <h2 class="fw-semibold mb-4 text-center text-primary">Featured Products</h2>
        <div class="row">
            @php
                $sample = [
                  ['id'=>1,'title'=>'Hydrating Serum','short'=>'Lightweight serum','price'=>1800,'image'=>'serum.jpg'],
                  ['id'=>2,'title'=>'Mattifying Moisturizer','short'=>'Controls oil','price'=>1500,'image'=>'moisturizer.jpg'],
                  ['id'=>3,'title'=>'Balance Cleanser','short'=>'Gentle cleanser','price'=>900,'image'=>'cleanser.jpg'],
                ];
            @endphp
            @foreach($sample as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

@endsection

