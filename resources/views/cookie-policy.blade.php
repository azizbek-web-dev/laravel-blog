@extends('layouts.app')

@section('title', 'Cookie Policy - MetaBlog Technology & Lifestyle Blog')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Cookie Policy</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Cookie Policy</span>
                </nav>
            </div>
        </section>

        <!-- Cookie Policy Content Section -->
        <section class="cookie-policy-section">
            <div class="container">
                <div class="cookie-policy-content">
                    <div class="cookie-policy-intro">
                        <div class="cookie-policy-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Last updated: December 15, 2024</span>
                        </div>
                        <p class="cookie-policy-description">
                            This Cookie Policy explains how MetaBlog ("we," "us," or "our") uses cookies and similar technologies when you visit our website. By using our website, you consent to the use of cookies as described in this policy.
                        </p>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">What Are Cookies?</h2>
                        <p>Cookies are small text files that are stored on your device (computer, tablet, or mobile phone) when you visit a website. They help websites remember information about your visit, such as your preferred language and other settings, which can make your next visit easier and the site more useful to you.</p>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">How We Use Cookies</h2>
                        <p>We use cookies for several purposes, including:</p>
                        <ul class="cookie-policy-list">
                            <li><strong>Essential Cookies:</strong> These cookies are necessary for the website to function properly and cannot be disabled.</li>
                            <li><strong>Performance Cookies:</strong> These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</li>
                            <li><strong>Functional Cookies:</strong> These cookies enable the website to provide enhanced functionality and personalization.</li>
                            <li><strong>Targeting Cookies:</strong> These cookies may be set through our site by our advertising partners to build a profile of your interests.</li>
                        </ul>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Types of Cookies We Use</h2>
                        
                        <div class="cookie-category">
                            <h3 class="cookie-category-title">Essential Cookies</h3>
                            <p>These cookies are essential for the operation of our website and cannot be disabled. They include:</p>
                            <ul class="cookie-policy-list">
                                <li>Authentication cookies that keep you logged in</li>
                                <li>Security cookies that protect against fraud</li>
                                <li>Session cookies that maintain your browsing session</li>
                            </ul>
                        </div>

                        <div class="cookie-category">
                            <h3 class="cookie-category-title">Analytics Cookies</h3>
                            <p>We use analytics cookies to understand how our website is used and to improve our services:</p>
                            <ul class="cookie-policy-list">
                                <li>Google Analytics cookies to track website traffic</li>
                                <li>Performance monitoring cookies</li>
                                <li>User behavior analysis cookies</li>
                            </ul>
                        </div>

                        <div class="cookie-category">
                            <h3 class="cookie-category-title">Preference Cookies</h3>
                            <p>These cookies remember your preferences and settings:</p>
                            <ul class="cookie-policy-list">
                                <li>Language preference cookies</li>
                                <li>Theme preference cookies (light/dark mode)</li>
                                <li>Layout and display preference cookies</li>
                            </ul>
                        </div>

                        <div class="cookie-category">
                            <h3 class="cookie-category-title">Marketing Cookies</h3>
                            <p>These cookies are used to deliver relevant advertisements:</p>
                            <ul class="cookie-policy-list">
                                <li>Social media integration cookies</li>
                                <li>Advertising network cookies</li>
                                <li>Retargeting cookies</li>
                            </ul>
                        </div>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Third-Party Cookies</h2>
                        <p>Some cookies on our website are set by third-party services that we use to enhance your experience:</p>
                        <ul class="cookie-policy-list">
                            <li><strong>Google Analytics:</strong> For website analytics and performance monitoring</li>
                            <li><strong>Social Media Platforms:</strong> For social sharing and integration features</li>
                            <li><strong>Advertising Networks:</strong> For displaying relevant advertisements</li>
                            <li><strong>Content Delivery Networks:</strong> For faster website loading</li>
                        </ul>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Cookie Duration</h2>
                        <p>Cookies on our website have different lifespans:</p>
                        <ul class="cookie-policy-list">
                            <li><strong>Session Cookies:</strong> These are temporary cookies that are deleted when you close your browser</li>
                            <li><strong>Persistent Cookies:</strong> These remain on your device for a set period or until you delete them</li>
                            <li><strong>First-Party Cookies:</strong> Set by our website and only accessible by us</li>
                            <li><strong>Third-Party Cookies:</strong> Set by external services and accessible by those services</li>
                        </ul>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Managing Your Cookie Preferences</h2>
                        <p>You have several options for managing cookies:</p>
                        
                        <div class="cookie-management-options">
                            <div class="cookie-option">
                                <h3 class="cookie-option-title">Browser Settings</h3>
                                <p>Most web browsers allow you to control cookies through their settings. You can:</p>
                                <ul class="cookie-policy-list">
                                    <li>Delete existing cookies</li>
                                    <li>Block cookies from being set</li>
                                    <li>Set your browser to ask for permission before setting cookies</li>
                                </ul>
                            </div>

                            <div class="cookie-option">
                                <h3 class="cookie-option-title">Cookie Consent Tool</h3>
                                <p>We provide a cookie consent tool that allows you to:</p>
                                <ul class="cookie-policy-list">
                                    <li>Accept or decline non-essential cookies</li>
                                    <li>Customize your cookie preferences</li>
                                    <li>Withdraw consent at any time</li>
                                </ul>
                            </div>

                            <div class="cookie-option">
                                <h3 class="cookie-option-title">Third-Party Opt-Outs</h3>
                                <p>For third-party cookies, you can opt out through:</p>
                                <ul class="cookie-policy-list">
                                    <li>Google Analytics opt-out browser add-on</li>
                                    <li>Digital Advertising Alliance opt-out page</li>
                                    <li>Individual service provider opt-out pages</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Impact of Disabling Cookies</h2>
                        <p>Please note that if you choose to disable certain cookies:</p>
                        <ul class="cookie-policy-list">
                            <li>Some website features may not function properly</li>
                            <li>Your user experience may be less personalized</li>
                            <li>We may not be able to provide certain services</li>
                            <li>Website performance may be affected</li>
                        </ul>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Updates to This Policy</h2>
                        <p>We may update this Cookie Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We will notify you of any material changes by posting the updated policy on our website and updating the "Last updated" date.</p>
                    </div>

                    <div class="cookie-policy-section-item">
                        <h2 class="cookie-policy-subtitle">Contact Us</h2>
                        <p>If you have any questions about our use of cookies or this Cookie Policy, please contact us:</p>
                        <div class="cookie-policy-contact">
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h3>Email</h3>
                                        <p>cookies@metablog.com</p>
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