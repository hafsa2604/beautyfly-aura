<footer style="background: linear-gradient(135deg, #2a1036, #4B0082); color: #f5e9ff; padding: 60px 0 0;">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h4 class="fw-bold text-white mb-3">BeautyFly Aura</h4>
                <p>Your glow, our passion 💫 — skincare crafted with love and science.</p>
                <div class="mt-3">
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>

            <div class="col-md-2">
                <h6 class="fw-semibold text-white mb-3">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}" class="text-light text-decoration-none d-block mb-2">Home</a></li>
                    <li><a href="{{ route('products') }}" class="text-light text-decoration-none d-block mb-2">Products</a></li>
                    <li><a href="{{ route('skin-type') }}" class="text-light text-decoration-none d-block mb-2">Skin Type Test</a></li>
                    <li><a href="{{ route('contact') }}" class="text-light text-decoration-none d-block mb-2">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6 class="fw-semibold text-white mb-3">Get in Touch</h6>
                <p class="small"><i class="bi bi-geo-alt-fill"></i> Karachi, Pakistan</p>
                <p class="small"><i class="bi bi-envelope"></i> info@beautyflyaura.com</p>
                <p class="small"><i class="bi bi-telephone"></i> +92 300 1234567</p>
            </div>

            <div class="col-md-3">
                <h6 class="fw-semibold text-white mb-3">We Accept</h6>
                <div class="d-flex gap-2 flex-wrap">
                    <img src="{{ asset('images/visa.png') }}" alt="Visa" style="height:28px;">
                    <img src="{{ asset('images/mastercard.png') }}" alt="Mastercard" style="height:28px;">
                    <img src="{{ asset('images/paypal.png') }}" alt="PayPal" style="height:28px;">
                </div>
                <p class="small mt-3">Secure transactions 🔒</p>
            </div>
        </div>

        <div class="text-center mt-5 py-3" style="background: rgba(255,255,255,0.1); border-top: 1px solid rgba(255,255,255,0.2); font-size: 0.9rem;">
            © {{ date('Y') }} <strong>BeautyFly Aura</strong> — All Rights Reserved 💜
        </div>
    </div>
</footer>

