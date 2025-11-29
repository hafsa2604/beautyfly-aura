@extends('layouts.layout')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #f8c9f9 0%, #d0a3ff 100%);
            min-height: 100vh;
        }

        h1, h2 {
            color: #6a1b9a;
            font-weight: 600;
        }

        .contact-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .contact-info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(107, 70, 193, 0.2);
        }

        .contact-icon-wrapper {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #7a1fa2 0%, #b84ad9 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            font-size: 1.75rem;
            box-shadow: 0 4px 15px rgba(122, 31, 162, 0.3);
        }

        iframe {
            border-radius: 15px;
            width: 100%;
            height: 300px;
            border: none;
        }
    </style>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3" style="color: #4B0082;">
                <i class="bi bi-envelope-heart me-2" style="color: #f7b9f4;"></i>Contact BeautyFly Aura
            </h1>
            <p class="text-muted">Have a question, feedback, or just want to say hi? We'd love to hear from you!</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-section">

            <!-- Contact Form -->
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label fw-semibold">Your Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control" required placeholder="Type your message here..."></textarea>
                </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-send me-2"></i>Send Message
                        </button>
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                </div>
            </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon-wrapper">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <h5 class="mt-3 mb-2" style="color: #4B0082;">Phone</h5>
                    <p class="text-muted mb-0">+92 300 1234567</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon-wrapper">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h5 class="mt-3 mb-2" style="color: #4B0082;">Email</h5>
                    <p class="text-muted mb-0">info@beautyflyaura.com</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon-wrapper">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5 class="mt-3 mb-2" style="color: #4B0082;">Location</h5>
                    <p class="text-muted mb-0">Karachi, Pakistan</p>
                </div>
            </div>
        </div>
    </div>
@endsection

