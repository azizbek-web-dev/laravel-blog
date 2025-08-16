@extends('layouts.app')

@section('title', 'About - DevMed.uz Technology & Lifestyle Blog')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">About Us</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">About</span>
                </nav>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <div class="container">
                <div class="about-content">
                    <div class="about-intro">
                        <h2>Welcome to MetaBlog</h2>
                        <p class="about-description">
                            MetaBlog is a technology and lifestyle blog dedicated to sharing insights, tips, and stories 
                            that inspire and inform our readers. We believe in the power of knowledge sharing and 
                            creating a community of curious minds.
                        </p>
                    </div>

                    <div class="about-mission">
                        <h3>Our Mission</h3>
                        <p>
                            To provide high-quality, engaging content that helps readers stay informed about the latest 
                            technology trends, maintain a healthy lifestyle, and make informed decisions in their 
                            personal and professional lives.
                        </p>
                    </div>

                    <div class="about-values">
                        <h3>Our Values</h3>
                        <div class="values-grid">
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h4>Innovation</h4>
                                <p>We embrace new ideas and technologies, always looking for ways to improve and evolve.</p>
                            </div>
                            
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4>Community</h4>
                                <p>We believe in building strong relationships with our readers and fostering meaningful discussions.</p>
                            </div>
                            
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4>Quality</h4>
                                <p>We are committed to delivering accurate, well-researched, and valuable content to our audience.</p>
                            </div>
                            
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4>Passion</h4>
                                <p>We are passionate about what we do and it shows in every piece of content we create.</p>
                            </div>
                        </div>
                    </div>

                    <div class="about-team">
                        <h3>Meet Our Team</h3>
                        <div class="team-grid">
                            <div class="team-member">
                                <div class="member-image">
                                    <img src="img/author-1.png" alt="Azizbek Hakimov">
                                </div>
                                <div class="member-info">
                                    <h4>Azizbek Hakimov</h4>
                                    <p class="member-role">Founder & Lead Writer</p>
                                    <p class="member-bio">
                                        Azizbek is a software engineer and passionate blogger with years of experience 
                                        in technology and digital content creation.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-stats">
                        <h3>Our Impact</h3>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">100+</div>
                                <div class="stat-label">Articles Published</div>
                            </div>
                            
                            <div class="stat-item">
                                <div class="stat-number">10K+</div>
                                <div class="stat-label">Happy Readers</div>
                            </div>
                            
                            <div class="stat-item">
                                <div class="stat-number">50+</div>
                                <div class="stat-label">Categories Covered</div>
                            </div>
                            
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Content Available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
