@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('styles')
<style>
    .settings-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .settings-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .settings-header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .settings-header p {
        margin: 1rem 0 0 0;
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .settings-tabs {
        border: none;
        background: #f8fafc;
        border-radius: 12px;
        padding: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .settings-tabs .nav-link {
        border: none;
        border-radius: 8px;
        padding: 1rem 1.5rem;
        margin: 0 0.25rem;
        color: #64748b;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .settings-tabs .nav-link:hover {
        background: #e2e8f0;
        color: #475569;
    }
    
    .settings-tabs .nav-link.active {
        background: #6366f1;
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }
    
    .tab-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }
    
    .setting-group {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .setting-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .setting-group h3 {
        color: #1e293b;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .setting-group h3 i {
        color: #6366f1;
    }
    
    .setting-item {
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    
    .setting-item:last-child {
        margin-bottom: 0;
    }
    
    .setting-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .setting-description {
        color: #6b7280;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    .setting-input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .setting-input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .setting-textarea {
        min-height: 100px;
        resize: vertical;
    }
    
    .setting-select {
        background: white;
    }
    
    .setting-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #6366f1;
    }
    
    .setting-image-preview {
        max-width: 200px;
        border-radius: 8px;
        margin-top: 0.5rem;
        border: 2px solid #e2e8f0;
    }
    
    .actions-bar {
        background: #f8fafc;
        padding: 1.5rem;
        border-radius: 12px;
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e2e8f0;
    }
    
    .btn-save {
        background: #10b981;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .btn-save:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-reset {
        background: #f59e0b;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .btn-reset:hover {
        background: #d97706;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    /* SEO Documentation Styles */
    .seo-docs {
        background: #f0f9ff;
        border: 1px solid #0ea5e9;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .seo-docs h4 {
        color: #0369a1;
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }
    
    .seo-docs ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    
    .seo-docs li {
        margin-bottom: 0.5rem;
        color: #0c4a6e;
        line-height: 1.6;
    }
    
    .seo-tips {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .seo-tips h5 {
        color: #92400e;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }
    
    .seo-tips p {
        color: #78350f;
        margin: 0;
        line-height: 1.6;
    }
    
    .help-section {
        background: #f3f4f6;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
        border-left: 4px solid #6366f1;
    }
    
    .help-section h6 {
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }
    
    .help-section p {
        color: #6b7280;
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.5;
    }
    
    .code-example {
        background: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        margin: 0.5rem 0;
        overflow-x: auto;
    }
    
    .status-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }
    
    .status-active {
        background: #10b981;
    }
    
    .status-inactive {
        background: #ef4444;
    }
    
    @media (max-width: 768px) {
        .settings-container {
            padding: 1rem;
        }
        
        .settings-header {
            padding: 1.5rem;
        }
        
        .settings-header h1 {
            font-size: 2rem;
        }
        
        .tab-content {
            padding: 1.5rem;
        }
        
        .actions-bar {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Site Settings</h1>
            <div>
                <form action="{{ route('admin.settings.reset') }}" method="POST" class="d-inline" 
                      onsubmit="return confirm('Are you sure you want to reset all settings to defaults?')">
                    @csrf
                    <button type="submit" class="btn btn-warning me-2">
                        <i class="fas fa-undo"></i> Reset to Defaults
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Settings Tabs -->
    <ul class="nav nav-tabs settings-tabs" id="settingsTabs" role="tablist">
        @foreach($groups as $groupKey => $groupLabel)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                    id="{{ $groupKey }}-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#{{ $groupKey }}" 
                    type="button" 
                    role="tab">
                {{ $groupLabel }}
            </button>
        </li>
        @endforeach
        
        <!-- SEO Documentation Tab -->
        <li class="nav-item" role="presentation">
            <button class="nav-link" 
                    id="seo-docs-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#seo-docs" 
                    type="button" 
                    role="tab">
                <i class="fas fa-search"></i> SEO Guide
            </button>
        </li>
    </ul>
    
    <!-- Settings Content -->
    <div class="tab-content" id="settingsTabsContent">
        @foreach($groups as $groupKey => $groupLabel)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
             id="{{ $groupKey }}" 
             role="tabpanel">
            
            <div class="setting-group">
                @if(isset($settings[$groupKey]) && $settings[$groupKey]->count() > 0)
                    @foreach($settings[$groupKey] as $setting)
                    <div class="setting-item">
                        <div class="setting-label">{{ $setting->label }}</div>
                        @if($setting->description)
                        <div class="setting-description">{{ $setting->description }}</div>
                        @endif
                        
                        @switch($setting->type)
                            @case('text')
                                <input type="text" 
                                       class="setting-input" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ $setting->value }}"
                                       placeholder="Enter {{ strtolower($setting->label) }}">
                                @break
                                
                            @case('textarea')
                                <textarea class="setting-input setting-textarea" 
                                          name="settings[{{ $setting->key }}]" 
                                          placeholder="Enter {{ strtolower($setting->label) }}">{{ $setting->value }}</textarea>
                                @break
                                
                            @case('image')
                                <input type="file" 
                                       class="setting-input" 
                                       name="settings[{{ $setting->key }}]" 
                                       accept="image/*">
                                @if($setting->value)
                                <div class="mt-2">
                                    <strong>Current:</strong>
                                    <img src="{{ asset($setting->value) }}" alt="{{ $setting->label }}" class="setting-image-preview">
                                </div>
                                @endif
                                @break
                                
                            @case('select')
                                <select class="setting-input setting-select" name="settings[{{ $setting->key }}]">
                                    @if($setting->options)
                                        @foreach($setting->options as $optionValue => $optionLabel)
                                        <option value="{{ $optionValue }}" {{ $setting->value == $optionValue ? 'selected' : '' }}>
                                            {{ $optionLabel }}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                                @break
                                
                            @case('boolean')
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="setting-checkbox form-check-input" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="1" 
                                           {{ $setting->value == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Enable {{ $setting->label }}</label>
                                </div>
                                @break
                                
                            @default
                                <input type="text" 
                                       class="setting-input" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ $setting->value }}">
                        @endswitch
                    </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-cog fa-3x mb-3"></i>
                        <p>No settings found for this group.</p>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
        
        <!-- SEO Documentation Tab Content -->
        <div class="tab-pane fade" id="seo-docs" role="tabpanel" aria-labelledby="seo-docs-tab">
            <!-- SEO Documentation Header -->
            <div class="seo-docs">
                <h4><i class="fas fa-search"></i> SEO Settings Guide</h4>
                <p><strong>Search Engine Optimization (SEO)</strong> helps your website rank better in search results. Configure these settings to improve your site's visibility.</p>
            </div>

            <!-- SEO Tips -->
            <div class="seo-tips">
                <h5><i class="fas fa-lightbulb"></i> Pro Tips</h5>
                <p><strong>Meta Title:</strong> Keep it under 60 characters for optimal display in search results. Include your main keyword naturally.</p>
                <p><strong>Meta Description:</strong> Write compelling descriptions under 160 characters. This appears below your title in search results.</p>
                <p><strong>Keywords:</strong> Use relevant, specific keywords separated by commas. Focus on what your audience searches for.</p>
            </div>

            <!-- Google Analytics Section -->
            <div class="setting-group">
                <h3><i class="fab fa-google"></i> Google Services</h3>
                
                <div class="setting-item">
                    <label class="setting-label">Google Analytics Code</label>
                    <div class="setting-description">
                        <strong>What is it?</strong> Google Analytics tracks your website visitors and provides detailed insights about your audience.<br>
                        <strong>How to get it:</strong> Go to <a href="https://analytics.google.com" target="_blank">Google Analytics</a> → Create Account → Get Tracking ID (GTM-XXXXXXX)<br>
                        <strong>Format:</strong> GTM-XXXXXXX or UA-XXXXXXXXX-X
                    </div>
                    <div class="help-section">
                        <h6>Why Google Analytics?</h6>
                        <p>• Track page views and user behavior<br>• Understand your audience demographics<br>• Monitor traffic sources and conversions<br>• Make data-driven decisions</p>
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Google Search Console</label>
                    <div class="setting-description">
                        <strong>What is it?</strong> Monitor your site's search performance and fix issues that affect your search rankings.<br>
                        <strong>How to get it:</strong> Go to <a href="https://search.google.com/search-console" target="_blank">Google Search Console</a> → Add Property → Get verification code
                    </div>
                    <div class="help-section">
                        <h6>Benefits of Search Console:</h6>
                        <p>• Monitor search performance<br>• Submit sitemaps<br>• Fix indexing issues<br>• Track keyword rankings</p>
                    </div>
                </div>
            </div>

            <!-- Meta Tags Section -->
            <div class="setting-group">
                <h3><i class="fas fa-tags"></i> Meta Tags</h3>
                
                <div class="setting-item">
                    <label class="setting-label">Meta Author</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Specifies the author of your website content.<br>
                        <strong>Best practice:</strong> Use your name or company name consistently across all pages.
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Meta Robots</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Tells search engines how to index and follow your pages.<br>
                        <strong>Common values:</strong><br>
                        • <code>index, follow</code> - Default, allows indexing and following links<br>
                        • <code>noindex, nofollow</code> - Prevents indexing and following<br>
                        • <code>index, nofollow</code> - Allows indexing but doesn't follow links
                    </div>
                </div>
            </div>

            <!-- Social Media Section -->
            <div class="setting-group">
                <h3><i class="fas fa-share-alt"></i> Social Media (Open Graph)</h3>
                
                <div class="setting-item">
                    <label class="setting-label">Default OG Image</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Image displayed when your content is shared on social media (Facebook, Twitter, LinkedIn).<br>
                        <strong>Recommended size:</strong> 1200x630 pixels (1.91:1 ratio)<br>
                        <strong>File format:</strong> JPG or PNG (under 1MB)
                    </div>
                    <div class="help-section">
                        <h6>Social Media Best Practices:</h6>
                        <p>• Use high-quality, relevant images<br>• Keep text minimal on images<br>• Test how it looks on different platforms<br>• Ensure good contrast and readability</p>
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Twitter Card Type</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Controls how your content appears when shared on Twitter.<br>
                        <strong>Summary:</strong> Small image with text (144x144px)<br>
                        <strong>Summary Large Image:</strong> Large image with text (1200x600px) - Recommended
                    </div>
                </div>
            </div>

            <!-- Advanced SEO Section -->
            <div class="setting-group">
                <h3><i class="fas fa-cogs"></i> Advanced SEO</h3>
                
                <div class="setting-item">
                    <label class="setting-label">Canonical URL</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Prevents duplicate content issues by specifying the preferred URL for your content.<br>
                        <strong>When to use:</strong> When you have multiple URLs pointing to the same content.<br>
                        <strong>Example:</strong> https://yoursite.com/post instead of https://yoursite.com/post?utm_source=google
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Structured Data</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Helps search engines understand your content better, potentially showing rich snippets in search results.<br>
                        <strong>Benefits:</strong> Better search visibility, rich results, improved click-through rates.
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Sitemap Generation</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> XML sitemap helps search engines discover and index all your pages.<br>
                        <strong>Benefits:</strong> Faster indexing, better crawl efficiency, improved SEO performance.
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Default Sitemap Priority</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Tells search engines how important a page is relative to other pages on your site.<br>
                        <strong>Scale:</strong> 0.1 (lowest) to 1.0 (highest)<br>
                        <strong>Homepage:</strong> Usually 1.0<br>
                        <strong>Blog posts:</strong> Usually 0.8<br>
                        <strong>Categories:</strong> Usually 0.6
                    </div>
                </div>

                <div class="setting-item">
                    <label class="setting-label">Default Sitemap Change Frequency</label>
                    <div class="setting-description">
                        <strong>Purpose:</strong> Indicates how often the content of a page is likely to change.<br>
                        <strong>Blog posts:</strong> Usually "weekly" or "monthly"<br>
                        <strong>Static pages:</strong> Usually "monthly" or "yearly"<br>
                        <strong>News sites:</strong> Usually "daily" or "hourly"
                    </div>
                </div>
            </div>

            <!-- SEO Checklist -->
            <div class="seo-tips">
                <h5><i class="fas fa-clipboard-check"></i> SEO Checklist</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>✅ Meta title under 60 characters</li>
                            <li>✅ Meta description under 160 characters</li>
                            <li>✅ Relevant keywords included</li>
                            <li>✅ Canonical URL set (if needed)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="mb-0">
                            <li>✅ OG image uploaded (1200x630px)</li>
                            <li>✅ Google Analytics connected</li>
                            <li>✅ Sitemap generated</li>
                            <li>✅ Structured data enabled</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Code Examples -->
            <div class="code-example">
                <h6>Example Meta Tags for Your Pages:</h6>
                <pre>&lt;!-- Basic Meta Tags --&gt;
&lt;title&gt;Your Page Title&lt;/title&gt;
&lt;meta name="description" content="Your page description"&gt;
&lt;meta name="keywords" content="keyword1, keyword2"&gt;
&lt;meta name="author" content="Your Name"&gt;
&lt;meta name="robots" content="index, follow"&gt;

&lt;!-- Open Graph Tags --&gt;
&lt;meta property="og:title" content="Your OG Title"&gt;
&lt;meta property="og:description" content="Your OG Description"&gt;
&lt;meta property="og:image" content="https://yoursite.com/image.jpg"&gt;
&lt;meta property="og:type" content="website"&gt;

&lt;!-- Twitter Card --&gt;
&lt;meta name="twitter:card" content="summary_large_image"&gt;
&lt;meta name="twitter:title" content="Your Twitter Title"&gt;
&lt;meta name="twitter:description" content="Your Twitter Description"&gt;
&lt;meta name="twitter:image" content="https://yoursite.com/image.jpg"&gt;</pre>
            </div>

            <!-- SEO Tools & Resources -->
            <div class="seo-docs">
                <h4><i class="fas fa-tools"></i> Useful SEO Tools</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Free Tools:</h6>
                        <ul>
                            <li><a href="https://pagespeed.web.dev/" target="_blank">Google PageSpeed Insights</a> - Test website speed</li>
                            <li><a href="https://search.google.com/test/mobile-friendly" target="_blank">Mobile-Friendly Test</a> - Check mobile optimization</li>
                            <li><a href="https://www.xml-sitemaps.com/" target="_blank">XML Sitemaps Generator</a> - Create sitemaps</li>
                            <li><a href="https://metatags.io/" target="_blank">Meta Tags Generator</a> - Generate meta tags</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Paid Tools:</h6>
                        <ul>
                            <li><a href="https://moz.com/" target="_blank">Moz Pro</a> - Comprehensive SEO suite</li>
                            <li><a href="https://ahrefs.com/" target="_blank">Ahrefs</a> - Backlink and keyword research</li>
                            <li><a href="https://www.semrush.com/" target="_blank">SEMrush</a> - Competitor analysis</li>
                            <li><a href="https://www.screamingfrog.co.uk/seo-spider/" target="_blank">Screaming Frog</a> - Technical SEO audit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Common SEO Mistakes -->
            <div class="seo-tips">
                <h5><i class="fas fa-exclamation-triangle"></i> Common SEO Mistakes to Avoid</h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>❌ Duplicate content without canonical URLs</li>
                            <li>❌ Missing meta descriptions</li>
                            <li>❌ Slow loading pages</li>
                            <li>❌ Not mobile-friendly</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>❌ Keyword stuffing</li>
                            <li>❌ Broken internal links</li>
                            <li>❌ Missing alt text for images</li>
                            <li>❌ No XML sitemap</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions Bar -->
    <div class="actions-bar">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save All Settings
            </button>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    // Auto-save form data to localStorage
    document.querySelectorAll('input, textarea, select').forEach(function(element) {
        element.addEventListener('input', function() {
            localStorage.setItem('settings_' + this.name, this.value);
        });
        
        // Restore saved data
        const savedValue = localStorage.getItem('settings_' + this.name);
        if (savedValue && this.type !== 'file') {
            this.value = savedValue;
        }
    });
    
    // Clear localStorage on successful save
    document.querySelector('form').addEventListener('submit', function() {
        localStorage.clear();
    });
</script>
@endsection 