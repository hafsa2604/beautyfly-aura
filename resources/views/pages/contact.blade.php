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
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 60px auto;
        }

        .btn-purple {
            background-color: #ba68c8;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #9c27b0;
            transform: scale(1.05);
        }

        .contact-info {
            text-align: center;
            margin-top: 30px;
        }

        .contact-info p {
            color: #555;
            font-size: 1rem;
        }

        .contact-icon {
            font-size: 1.5rem;
            color: #9c27b0;
            margin-right: 10px;
        }

        iframe {
            border-radius: 15px;
            width: 100%;
            height: 300px;
            border: none;
        }
    </style>

    <div class="container">
        <div class="contact-section">
            <h1 class="text-center mb-4">📞 Contact BeautyFly Aura</h1>
            <p class="text-center text-muted mb-5">
                Have a question, feedback, or just want to say hi?
                We’d love to hear from you! Fill out the form below or reach us through our socials.
            </p>

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
                    <button type="submit" class="btn btn-purple">Send Message</button>
                </div>
            </form>

            <!-- Contact Info -->
            <div class="contact-info mt-5">
                <h2 class="mb-3">🌸 Get in Touch</h2>
                <p><i class="contact-icon bi bi-instagram"></i> <strong>Instagram:</strong> <a href="https://www.instagram.com/beautyflyaura" target="_blank">@beautyflyaura</a></p>
                <p><i class="contact-icon bi bi-telephone-fill"></i> <strong>Phone:</strong> +92 300 1234567</p>
                <p><i class="contact-icon bi bi-geo-alt-fill"></i> <strong>Location:</strong> AURA CLUB, Karachi, Pakistan</p>
            </div>


        </div>
    </div>
@endsection

