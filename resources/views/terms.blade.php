@extends('layouts.app')

@section('title', 'Terms of Use - MetaBlog Technology & Lifestyle Blog')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Terms of Use</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Terms of Use</span>
                </nav>
            </div>
        </section>

        <!-- Terms Content Section -->
        <section class="terms-section">
            <div class="container">
                <div class="terms-content">
                    <div class="terms-intro">
                        <p class="terms-date">Last updated: December 15, 2023</p>
                        <p class="terms-description">
                            These Terms of Use govern your use of MetaBlog and any related services. By accessing or using our website, you agree to be bound by these terms.
                        </p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">1. Acceptance of Terms</h2>
                        <p>By accessing and using MetaBlog, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">2. Use License</h2>
                        <p>Permission is granted to temporarily download one copy of the materials (information or software) on MetaBlog for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                        <ul class="terms-list">
                            <li>Modify or copy the materials</li>
                            <li>Use the materials for any commercial purpose or for any public display</li>
                            <li>Attempt to reverse engineer any software contained on MetaBlog</li>
                            <li>Remove any copyright or other proprietary notations from the materials</li>
                            <li>Transfer the materials to another person or "mirror" the materials on any other server</li>
                        </ul>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">3. User Content</h2>
                        <p>By posting content to MetaBlog, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, modify, and distribute your content in connection with the website and our business.</p>
                        <p>You are responsible for ensuring that any content you post:</p>
                        <ul class="terms-list">
                            <li>Is accurate and truthful</li>
                            <li>Does not violate any laws or regulations</li>
                            <li>Does not infringe on the rights of others</li>
                            <li>Is not defamatory, obscene, or offensive</li>
                        </ul>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">4. Privacy Policy</h2>
                        <p>Your privacy is important to us. Please review our <a href="privacy.html">Privacy Policy</a>, which also governs your use of the website, to understand our practices.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">5. Intellectual Property</h2>
                        <p>The content on MetaBlog, including but not limited to text, graphics, images, logos, and software, is the property of MetaBlog or its content suppliers and is protected by copyright laws.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">6. Disclaimer</h2>
                        <p>The materials on MetaBlog are provided on an 'as is' basis. MetaBlog makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">7. Limitations</h2>
                        <p>In no event shall MetaBlog or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on MetaBlog.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">8. Revisions and Errata</h2>
                        <p>The materials appearing on MetaBlog could include technical, typographical, or photographic errors. MetaBlog does not warrant that any of the materials on its website are accurate, complete, or current.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">9. Links</h2>
                        <p>MetaBlog has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by MetaBlog of the site.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">10. Modifications</h2>
                        <p>MetaBlog may revise these terms of use for its website at any time without notice. By using this website, you are agreeing to be bound by the then current version of these Terms of Service.</p>
                    </div>

                    <div class="terms-section-item">
                        <h2 class="terms-subtitle">11. Governing Law</h2>
                        <p>These terms and conditions are governed by and construed in accordance with the laws and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>
                    </div>

                    <div class="terms-contact">
                        <h2 class="terms-subtitle">Contact Information</h2>
                        <p>If you have any questions about these Terms of Use, please contact us:</p>
                        <div class="contact-methods">
                            <div class="contact-method">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h3>Email</h3>
                                    <p>legal@metablog.com</p>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection