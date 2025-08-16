@extends('admin.layouts.app')

@section('title', 'Add New Author')

@section('styles')
<style>
    .seo-counter {
        font-size: 0.75rem;
        color: #6b7280;
        text-align: right;
        margin-top: 0.25rem;
    }
    
    .seo-counter.warning {
        color: #f59e0b;
    }
    
    .seo-counter.danger {
        color: #ef4444;
    }
    
    .card-header h6 {
        margin: 0;
        font-size: 1rem;
    }
    
    .card-header i {
        margin-right: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Add New Author</h1>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Authors
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Author Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Minimum 8 characters</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="4">{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Tell us a bit about the author (optional)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Recommended size: 300x300px</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Image Preview</label>
                        <div id="imagePreview" class="border rounded p-2 text-center" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <!-- Social Media Links -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fab fa-share-alt"></i> Social Media Links
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="twitter" class="form-label">Twitter</label>
                                        <input type="url" class="form-control @error('twitter') is-invalid @enderror" 
                                               id="twitter" name="twitter" value="{{ old('twitter') }}" 
                                               placeholder="https://twitter.com/username">
                                        @error('twitter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="linkedin" class="form-label">LinkedIn</label>
                                        <input type="url" class="form-control @error('linkedin') is-invalid @enderror" 
                                               id="linkedin" name="linkedin" value="{{ old('linkedin') }}" 
                                               placeholder="https://linkedin.com/in/username">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="github" class="form-label">GitHub</label>
                                        <input type="url" class="form-control @error('github') is-invalid @enderror" 
                                               id="github" name="github" value="{{ old('github') }}" 
                                               placeholder="https://github.com/username">
                                        @error('github')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SEO Settings -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-search"></i> SEO Settings
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <div class="form-text">Title for search engines (max 60 characters)</div>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                               id="meta_title" name="meta_title" value="{{ old('meta_title') }}" 
                                               maxlength="60" placeholder="Enter meta title for SEO">
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="seo-counter" id="meta_title_counter">0/60</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <div class="form-text">Description for search engines (max 160 characters)</div>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                                  id="meta_description" name="meta_description" 
                                                  maxlength="160" rows="3" 
                                                  placeholder="Enter meta description for SEO">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="seo-counter" id="meta_description_counter">0/160</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <div class="form-text">Keywords for search engines (comma separated)</div>
                                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                               id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" 
                                               maxlength="255" placeholder="author, writer, blogger, expert">
                                        @error('meta_keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="canonical_url" class="form-label">Canonical URL</label>
                                        <div class="form-text">Preferred URL for this author (optional)</div>
                                        <input type="url" class="form-control @error('canonical_url') is-invalid @enderror" 
                                               id="canonical_url" name="canonical_url" value="{{ old('canonical_url') }}" 
                                               placeholder="https://yoursite.com/authors/author-name">
                                        @error('canonical_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <h6 class="mb-3">
                                <i class="fas fa-share-alt"></i> Social Media (Open Graph)
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="og_title" class="form-label">OG Title</label>
                                        <div class="form-text">Title for social media sharing (max 95 characters)</div>
                                        <input type="text" class="form-control @error('og_title') is-invalid @enderror" 
                                               id="og_title" name="og_title" value="{{ old('og_title') }}" 
                                               maxlength="95" placeholder="Enter Open Graph title">
                                        @error('og_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="seo-counter" id="og_title_counter">0/95</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="og_description" class="form-label">OG Description</label>
                                        <div class="form-text">Description for social media sharing (max 200 characters)</div>
                                        <textarea class="form-control @error('og_description') is-invalid @enderror" 
                                                  id="og_description" name="og_description" 
                                                  maxlength="200" rows="3" 
                                                  placeholder="Enter Open Graph description">{{ old('og_description') }}</textarea>
                                        @error('og_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="seo-counter" id="og_description_counter">0/200</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="og_image" class="form-label">OG Image</label>
                                <div class="form-text">Image for social media sharing (1200x630px recommended)</div>
                                <input type="file" class="form-control @error('og_image') is-invalid @enderror" 
                                       id="og_image" name="og_image" accept="image/*">
                                @error('og_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to use profile image</div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Author
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // Character counters for SEO fields
    function setupCharacterCounter(fieldId, counterId, maxLength) {
        const field = document.getElementById(fieldId);
        const counter = document.getElementById(counterId);
        
        if (field && counter) {
            function updateCounter() {
                const length = field.value.length;
                const remaining = maxLength - length;
                
                counter.textContent = `${length}/${maxLength}`;
                counter.className = 'seo-counter';
                
                if (remaining <= 10) {
                    counter.classList.add('danger');
                } else if (remaining <= 20) {
                    counter.classList.add('warning');
                }
            }
            
            field.addEventListener('input', updateCounter);
            updateCounter(); // Initial count
        }
    }

    // Setup all character counters
    setupCharacterCounter('meta_title', 'meta_title_counter', 60);
    setupCharacterCounter('meta_description', 'meta_description_counter', 160);
    setupCharacterCounter('og_title', 'og_title_counter', 95);
    setupCharacterCounter('og_description', 'og_description_counter', 200);

    // Auto-fill SEO fields from name if empty
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        
        // Auto-fill meta title if empty
        const metaTitle = document.getElementById('meta_title');
        if (metaTitle && !metaTitle.value) {
            metaTitle.value = name;
            // Trigger counter update
            metaTitle.dispatchEvent(new Event('input'));
        }
        
        // Auto-fill OG title if empty
        const ogTitle = document.getElementById('og_title');
        if (ogTitle && !ogTitle.value) {
            ogTitle.value = name;
            // Trigger counter update
            ogTitle.dispatchEvent(new Event('input'));
        }
    });

    // Auto-fill excerpt if empty
    document.getElementById('bio').addEventListener('input', function() {
        const bio = this.value;
        
        // Auto-fill meta description if empty
        const metaDescription = document.getElementById('meta_description');
        if (metaDescription && !metaDescription.value) {
            metaDescription.value = bio;
            // Trigger counter update
            metaDescription.dispatchEvent(new Event('input'));
        }
        
        // Auto-fill OG description if empty
        const ogDescription = document.getElementById('og_description');
        if (ogDescription && !ogDescription.value) {
            ogDescription.value = bio;
            // Trigger counter update
            ogDescription.dispatchEvent(new Event('input'));
        }
    });
</script>
@endsection




