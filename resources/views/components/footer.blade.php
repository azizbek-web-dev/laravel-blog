<!-- Footer -->
<footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>About</h3>
                    <p>DevMed.uz is a technology and lifestyle blog dedicated to sharing insights, tips, and stories that inspire and inform our readers.</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> info@devmed.uz</p>
                        <p><i class="fas fa-phone"></i> +998 (90) 123-4567</p>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Link</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('authors') }}">Authors</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Category</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('blog') }}?category=technology">Technology</a></li>
                        <li><a href="{{ route('blog') }}?category=lifestyle">Lifestyle</a></li>
                        <li><a href="{{ route('blog') }}?category=travel">Travel</a></li>
                        <li><a href="{{ route('blog') }}?category=business">Business</a></li>
                        <li><a href="{{ route('blog') }}?category=health">Health</a></li>
                        <li><a href="{{ route('blog') }}?category=food">Food</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Weekly Newsletter</h3>
                    <p>Get blog articles and offers via email</p>
                    <div class="newsletter-form">
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Your Email" class="newsletter-input">
                        </div>
                        <button class="subscribe-btn">Subscribe</button>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-left">
                    <span class="copyright">© DevMed.uz {{ date('Y') }}. All Rights Reserved.</span>
                    <div class="footer-logo">
                        <div class="logo-icon">D</div>
                        <span class="logo-text">
                            <span class="logo-dev">Dev</span>
                            <span class="logo-med">Med</span>
                            <span class="logo-uz">.uz</span>
                        </span>
                    </div>
                </div>
                <div class="footer-bottom-right">
                    <a href="{{ route('terms') }}" class="footer-link">Terms of Use</a>
                    <a href="{{ route('privacy') }}" class="footer-link">Privacy Policy</a>
                    <a href="{{ route('cookie-policy') }}" class="footer-link">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>