@extends('layouts.app')

@section('title', 'Privacy Policy - MetaBlog Technology & Lifestyle Blog')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Privacy Policy</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Privacy Policy</span>
                </nav>
            </div>
        </section>

        <!-- Privacy Content Section -->
        <section class="privacy-section">
            <div class="container">
                <div class="privacy-content">
                    <div class="privacy-intro">
                        <div class="privacy-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Last updated: December 15, 2024</span>
                        </div>
                        <p class="privacy-description">
                            This Privacy Policy describes how MetaBlog ("we," "us," or "our") collects, uses, and shares your personal information when you visit our website and use our services.
                        </p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Information We Collect</h2>
                        <p>We collect information you provide directly to us, such as when you:</p>
                        <ul class="privacy-list">
                            <li>Subscribe to our newsletter</li>
                            <li>Leave comments on our blog posts</li>
                            <li>Contact us through our contact form</li>
                            <li>Participate in surveys or promotions</li>
                        </ul>
                        <p>This information may include your name, email address, and any other information you choose to provide.</p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Automatically Collected Information</h2>
                        <p>When you visit our website, we automatically collect certain information about your device, including:</p>
                        <ul class="privacy-list">
                            <li>IP address and location data</li>
                            <li>Browser type and version</li>
                            <li>Operating system</li>
                            <li>Pages you visit and time spent</li>
                            <li>Referring website</li>
                        </ul>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">How We Use Your Information</h2>
                        <p>We use the information we collect to:</p>
                        <ul class="privacy-list">
                            <li>Provide and maintain our website</li>
                            <li>Send you newsletters and updates</li>
                            <li>Respond to your comments and questions</li>
                            <li>Improve our content and user experience</li>
                            <li>Analyze website usage and trends</li>
                            <li>Protect against fraud and abuse</li>
                        </ul>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Information Sharing</h2>
                        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except:</p>
                        <ul class="privacy-list">
                            <li>To comply with legal obligations</li>
                            <li>To protect our rights and safety</li>
                            <li>With service providers who assist in our operations</li>
                            <li>In connection with a business transfer or merger</li>
                        </ul>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Cookies and Tracking Technologies</h2>
                        <p>We use cookies and similar tracking technologies to:</p>
                        <ul class="privacy-list">
                            <li>Remember your preferences and settings</li>
                            <li>Analyze website traffic and usage</li>
                            <li>Provide personalized content and ads</li>
                            <li>Improve website functionality</li>
                        </ul>
                        <p>You can control cookie settings through your browser preferences.</p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Data Security</h2>
                        <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Your Rights</h2>
                        <p>Depending on your location, you may have certain rights regarding your personal information:</p>
                        <ul class="privacy-list">
                            <li>Access and review your data</li>
                            <li>Correct inaccurate information</li>
                            <li>Request deletion of your data</li>
                            <li>Object to certain processing activities</li>
                            <li>Withdraw consent where applicable</li>
                        </ul>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Children's Privacy</h2>
                        <p>Our website is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and believe your child has provided us with personal information, please contact us.</p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Changes to This Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. We encourage you to review this policy periodically.</p>
                    </div>

                    <div class="privacy-section-item">
                        <h2 class="privacy-subtitle">Contact Us</h2>
                        <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                        <div class="privacy-contact">
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3>Email</h3>
                                        <p>privacy@metablog.com</p>
                                    </div>
                                </div>
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3>Phone</h3>
                                        <p>+1 (555) 123-4567</p>
                                    </div>
                                </div>
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3>Address</h3>
                                        <p>123 Tech Street, Digital City, DC 12345</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection