<footer class="main-footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h4 class="fw-bold text-white mb-3">
                        <span class="brand-text-footer">BeautyFly <span class="brand-accent-footer">Aura</span></span>
                    </h4>
                    <p class="footer-tagline">Your glow, our passion 💫 — skincare crafted with love and science.</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1"></i>Home</a></li>
                    <li><a href="{{ route('products') }}"><i class="bi bi-chevron-right me-1"></i>Products</a></li>
                    <li><a href="{{ route('skin-type') }}"><i class="bi bi-chevron-right me-1"></i>Skin Type Test</a></li>
                    <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right me-1"></i>Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Get in Touch</h6>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Karachi, Pakistan</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope"></i>
                        <a href="mailto:info@beautyflyaura.com">info@beautyflyaura.com</a>
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        <a href="tel:+923001234567">+92 300 1234567</a>
                    </li>
                    <li>
                        <i class="bi bi-clock"></i>
                        <span>Mon - Sat: 9AM - 6PM</span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Newsletter</h6>
                <p class="footer-text">Subscribe to get special offers and skincare tips!</p>
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required>
                        <button class="btn btn-newsletter" type="submit">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" style="font-size: 0.85rem; padding: 0.5rem;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show mt-2" role="alert" style="font-size: 0.85rem; padding: 0.5rem;">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                        </div>
                    @endif
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <p class="mb-0">© {{ date('Y') }} <strong>BeautyFly Aura</strong> — All Rights Reserved 💜</p>
                </div>
            </div>
        </div>
    </div>
</footer>

