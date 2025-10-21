@extends('layouts.layout')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #f8c9f9 0%, #d0a3ff 100%);
            min-height: 100vh;
        }

        .hero-section {
            position: relative;
            background: url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
            color: #fff;
            padding: 120px 20px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 60px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(156, 39, 176, 0.55);
            backdrop-filter: blur(3px);
            z-index: 1;
            border-radius: 20px;
        }

        .hero-section .overlay {
            position: relative;
            z-index: 2;
        }

        .hero-section .site-title {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-section .lead {
            font-size: 1.2rem;
            color: #f3e5f5;
        }

        .btn-purple {
            background-color: #ba68c8;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #9c27b0;
            transform: scale(1.05);
        }

        h2.text-primary {
            color: #6a1b9a !important;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="overlay">
            <h1 class="site-title">BeautyFly Aura</h1>
            <p class="lead mt-3">Discover your perfect skincare match — glow the way you deserve!</p>
            <div class="mt-4">
                <a class="btn btn-purple me-2" href="{{ route('products') }}">Browse Products</a>
                <a class="btn btn-outline-light" href="{{ route('skin-type') }}">Know Your Skin Type</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="container py-5 text-center">
        <h2 class="fw-semibold mb-3 text-primary">About BeautyFly Aura</h2>
        <p class="lead text-muted mb-4 px-3">
            At <strong>BeautyFly Aura</strong>, we believe every skin type deserves personalized care.
            Whether your skin is dry, oily, or combination, our goal is to simplify skincare and help you
            find products that actually work for your unique needs.
            From deep hydration to oil control, we make glowing skin effortless and enjoyable ✨
        </p>
    </section>

    <!-- Featured Products -->
    <section class="container py-5">
        <h2 class="fw-semibold mb-4 text-center text-primary">Featured Products</h2>
        <div class="row">
            @php
                $sample = [
                    ['id'=>1,'title'=>'Hydrating Serum','short'=>'Lightweight serum for dry skin','price'=>1800,'image'=>'serum.jpg'],
                    ['id'=>2,'title'=>'Mattifying Moisturizer','short'=>'Controls oil and shine','price'=>1500,'image'=>'gel.jpg'],
                    ['id'=>3,'title'=>'Balance Cleanser','short'=>'Gentle cleanser for all skin types','price'=>900,'image'=>'cleanser.jpg'],
                ];
            @endphp
            @foreach($sample as $product)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">{{ $product['title'] }}</h5>
                            <p class="text-muted small">{{ $product['short'] }}</p>
                            <p class="fw-semibold mb-2">Rs {{ $product['price'] }}</p>
                            <a href="{{ route('product.show', $product['id']) }}" class="btn btn-purple">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection


