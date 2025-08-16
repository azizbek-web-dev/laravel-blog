@extends('layouts.app')

@section('title', 'Contact - DevMed.uz Technology & Lifestyle Blog')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Contact Us</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Contact</span>
                </nav>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <div class="contact-content">
                    <!-- Contact Info -->
                    <div class="contact-info-section">
                        <h2 class="contact-subtitle">Get in Touch</h2>
                        <p class="contact-description">
                            Have a question or want to collaborate? We'd love to hear from you. 
                            Send us a message and we'll respond as soon as possible.
                        </p>
                        
                        <div class="contact-methods">
                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Email</h3>
                                    <p>info@metablog.com</p>
                                    <p>support@metablog.com</p>
                                </div>
                            </div>
                            
                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Phone</h3>
                                    <p>+1 (555) 123-4567</p>
                                    <p>+1 (555) 987-6543</p>
                                </div>
                            </div>
                            
                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Address</h3>
                                    <p>123 Tech Street</p>
                                    <p>Silicon Valley, CA 94025</p>
                                </div>
                            </div>
                            
                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Business Hours</h3>
                                    <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                    <p>Saturday: 10:00 AM - 4:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-section">
                        <h2 class="contact-subtitle">Send Message</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form class="contact-form" id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName">First Name *</label>
                                    <input type="text" id="firstName" name="first_name" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name *</label>
                                    <input type="text" id="lastName" name="last_name" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required placeholder="Enter your email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input type="text" id="subject" name="subject" required placeholder="Enter your subject">
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="6" required placeholder="Tell us about your inquiry..."></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="container">
                <h2 class="contact-subtitle">Find Us</h2>
                <div class="map-container">
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <h3>Interactive Map</h3>
                        <p>Google Maps integration would go here</p>
                        <span class="map-dimensions">100% x 400px</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <h2 class="contact-subtitle">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>How can I submit a guest post?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>You can submit a guest post by sending us an email with your article proposal. Please include a brief outline and your writing samples.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>What topics do you cover?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>We cover technology, lifestyle, business, travel, and various other topics that interest our readers.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>How long does it take to get a response?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>We typically respond to all inquiries within 24-48 hours during business days.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection