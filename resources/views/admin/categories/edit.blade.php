@extends('admin.layouts.app')

@section('title', 'Edit Category')

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
    
    .color-picker {
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    
    .color-picker:hover {
        transform: scale(1.1);
    }
    
    .icon-preview {
        font-size: 2rem;
        text-align: center;
        padding: 1rem;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        margin-top: 0.5rem;
        transition: all 0.3s;
    }
    
    .icon-preview:hover {
        border-color: #6366f1;
        background-color: #f8fafc;
    }
    
    .form-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .form-section h5 {
        color: #374151;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .btn-update {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.2s;
    }
    
    .btn-update:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .current-image {
        max-width: 200px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        margin-top: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">
                <i class="fas fa-edit text-primary"></i> Edit Category: {{ $category->name }}
            </h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="form-section">
                <h5><i class="fas fa-info-circle text-primary"></i> Basic Information</h5>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $category->name) }}" required 
                                   placeholder="Enter category name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="color" class="form-label">Category Color</label>
                            <input type="color" class="form-control color-picker @error('color') is-invalid @enderror" 
                                   id="color" name="color" value="{{ old('color', $category->color ?? '#6366f1') }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Choose a color for this category</div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" 
                              placeholder="Describe what this category is about">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Optional description for the category</div>
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Class</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                           id="icon" name="icon" value="{{ old('icon', $category->icon) }}" 
                           placeholder="fas fa-tag">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">FontAwesome icon class (e.g., fas fa-tag, fas fa-code)</div>
                    
                    <div class="icon-preview" id="iconPreview">
                        <i class="{{ $category->icon ?? 'fas fa-tag' }} text-muted"></i>
                    </div>
                </div>
            </div>
            
            <!-- SEO Settings -->
            <div class="form-section">
                <h5><i class="fas fa-search text-warning"></i> SEO Settings</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <div class="form-text">Title for search engines (max 60 characters)</div>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                   id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" 
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
                                      placeholder="Enter meta description for SEO">{{ old('meta_description', $category->meta_description) }}</textarea>
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
                                   id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" 
                                   maxlength="255" placeholder="category, topic, subject">
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="canonical_url" class="form-label">Canonical URL</label>
                            <div class="form-text">Preferred URL for this category (optional)</div>
                            <input type="url" class="form-control @error('canonical_url') is-invalid @enderror" 
                                   id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $category->canonical_url) }}" 
                                   placeholder="https://yoursite.com/categories/category-name">
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
                                   id="og_title" name="og_title" value="{{ old('og_title', $category->og_title) }}" 
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
                                      placeholder="Enter Open Graph description">{{ old('og_description', $category->og_description) }}</textarea>
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
                    
                    @if($category->og_image)
                        <div class="mb-2">
                            <strong>Current Image:</strong>
                            <img src="{{ asset('storage/' . $category->og_image) }}" alt="Current OG Image" class="current-image">
                        </div>
                    @endif
                    
                    <input type="file" class="form-control @error('og_image') is-invalid @enderror" 
                           id="og_image" name="og_image" accept="image/*">
                    @error('og_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Leave empty to keep current image</div>
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-danger" onclick="deleteCategory()">
                    <i class="fas fa-trash"></i> Delete Category
                </button>
                
                <button type="submit" class="btn-update">
                    <i class="fas fa-save"></i> Update Category
                </button>
            </div>
        </form>
        
        <!-- Delete Form -->
        <form id="deleteForm" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Icon preview
    document.getElementById('icon').addEventListener('input', function() {
        const iconClass = this.value || 'fas fa-tag';
        const preview = document.getElementById('iconPreview');
        preview.innerHTML = `<i class="${iconClass} text-muted"></i>`;
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
            metaTitle.dispatchEvent(new Event('input'));
        }
        
        // Auto-fill OG title if empty
        const ogTitle = document.getElementById('og_title');
        if (ogTitle && !ogTitle.value) {
            ogTitle.value = name;
            ogTitle.dispatchEvent(new Event('input'));
        }
    });
    
    // Auto-fill description if empty
    document.getElementById('description').addEventListener('input', function() {
        const description = this.value;
        
        // Auto-fill meta description if empty
        const metaDescription = document.getElementById('meta_description');
        if (metaDescription && !metaDescription.value) {
            metaDescription.value = description;
            metaDescription.dispatchEvent(new Event('input'));
        }
        
        // Auto-fill OG description if empty
        const ogDescription = document.getElementById('og_description');
        if (ogDescription && !ogDescription.value) {
            ogDescription.value = description;
            ogDescription.dispatchEvent(new Event('input'));
        }
    });
    
    // Delete category confirmation
    function deleteCategory() {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection 