@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('styles')
<!-- Quill.js Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-editor {
        min-height: 500px !important;
        font-size: 16px;
        line-height: 1.6;
    }
    
    .ql-toolbar {
        border-radius: 8px 8px 0 0;
        border: 2px solid #e2e8f0;
        border-bottom: none;
        background: #f8fafc;
    }
    
    .ql-container {
        border-radius: 0 0 8px 8px;
        border: 2px solid #e2e8f0;
        border-top: none;
    }
    
    .ql-editor:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .form-content {
        position: relative;
        z-index: 1;
    }
    
    /* Improved form layout */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    /* Make content area wider */
    .content-area {
        grid-column: 1 / -1;
        margin-bottom: 2rem;
    }
    
    .content-area .ql-editor {
        min-height: 600px !important;
        width: 100% !important;
    }
    
    .content-area .ql-toolbar {
        width: 100% !important;
    }
    
    .content-area .ql-container {
        width: 100% !important;
    }
    
    /* Right sidebar styling */
    .right-sidebar {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        height: fit-content;
    }
    
    .right-sidebar .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .right-sidebar .form-control,
    .right-sidebar .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
    }
    
    .right-sidebar .form-control:focus,
    .right-sidebar .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }
    
    .image-preview-container {
        background: white;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        transition: all 0.2s;
    }
    
    .image-preview-container:hover {
        border-color: #6366f1;
        background: #f8fafc;
    }
    
    @media (max-width: 1200px) {
        .form-row {
            grid-template-columns: 1fr 350px;
            gap: 1.5rem;
        }
    }
    
    @media (max-width: 992px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .right-sidebar {
            order: -1;
            margin-bottom: 1.5rem;
        }
        
        .content-area .ql-editor {
            min-height: 500px !important;
        }
    }

    /* SEO Styling */
    .seo-counter {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
        text-align: right;
    }
    
    .seo-counter.warning {
        color: #ffc107;
    }
    
    .seo-counter.danger {
        color: #dc3545;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Post: {{ $post->title }}</h1>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Posts
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Post Information</h5>
    </div>
    <div class="card-body form-content">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
            @method('PUT')
            
            <!-- Content Editor - Full Width -->
            <div class="content-area">
                <div class="mb-3">
                    <label for="post_content" class="form-label">Content *</label>
                    <div id="editor" style="height: 400px; overflow-y: auto;"></div>
                    <textarea id="post_content" name="content" style="display: none;">{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief description of the post (optional)</div>
                    </div>
                </div>

                <div class="right-sidebar">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">New Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to keep current image</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div class="image-preview-container">
                            <img src="{{ asset($post->image) }}" alt="Current Image" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Image Preview</label>
                        <div id="newImagePreview" class="image-preview-container" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-search"></i> SEO Settings
                                <button type="button" class="btn btn-success btn-sm ms-2" onclick="autoFillSeo()">
                                    <i class="fas fa-magic"></i> Auto-Fill SEO
                                </button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                               value="{{ old('meta_title', $post->meta_title) }}" 
                                               maxlength="60" placeholder="Enter meta title for SEO">
                                        <div class="form-text">Title shown in search results (max 60 characters)</div>
                                        <div class="seo-counter" id="meta_title_counter">0/60</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" 
                                                  maxlength="160" rows="3" placeholder="Enter meta description for SEO">{{ old('meta_description', $post->meta_description) }}</textarea>
                                        <div class="form-text">Description shown in search results (max 160 characters)</div>
                                        <div class="seo-counter" id="meta_description_counter">0/160</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                               value="{{ old('meta_keywords', $post->meta_keywords) }}" 
                                               placeholder="Enter keywords separated by commas">
                                        <div class="form-text">Keywords for search engines (comma separated)</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="canonical_url" class="form-label">Canonical URL</label>
                                        <input type="url" class="form-control" id="canonical_url" name="canonical_url" 
                                               value="{{ old('canonical_url', $post->canonical_url) }}" 
                                               placeholder="Enter canonical URL">
                                        <div class="form-text">Preferred URL for this content (optional)</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="og_title" class="form-label">OG Title</label>
                                        <input type="text" class="form-control" id="og_title" name="og_title" 
                                               value="{{ old('og_title', $post->og_title) }}" 
                                               maxlength="95" placeholder="Enter OG title for social media">
                                        <div class="form-text">Title for social media sharing (max 95 characters)</div>
                                        <div class="seo-counter" id="og_title_counter">0/95</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="og_description" class="form-label">OG Description</label>
                                        <textarea class="form-control" id="og_description" name="og_description" 
                                                  maxlength="200" rows="3" placeholder="Enter OG description for social media">{{ old('og_description', $post->og_description) }}</textarea>
                                        <div class="form-text">Description for social media sharing (max 200 characters)</div>
                                        <div class="seo-counter" id="og_description_counter">0/200</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="og_image" class="form-label">OG Image</label>
                                        <input type="file" class="form-control" id="og_image" name="og_image" accept="image/*">
                                        <div class="form-text">Image for social media sharing (1200x630px recommended)</div>
                                        @if($post->og_image)
                                            <div class="mt-2">
                                                <small class="text-muted">Current OG Image:</small>
                                                <img src="{{ asset($post->og_image) }}" alt="Current OG Image" class="img-thumbnail d-block mt-1" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <hr>
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Update Post
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Quill.js Editor -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    // Simple and reliable Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['blockquote', 'code-block'],
                ['clean']
            ]
        },
        placeholder: 'Write your post content here...'
    });

    // Set initial content from existing post
    @if($post->content)
        quill.root.innerHTML = {!! json_encode($post->content) !!};
    @endif

    // Simple form submission - update textarea before submit
    document.getElementById('editForm').addEventListener('submit', function(e) {
        // Get Quill content and update hidden textarea
        var quillContent = quill.root.innerHTML;
        
        // Check if content is empty (only HTML tags)
        if (quillContent.trim() === '' || quillContent === '<p><br></p>' || quillContent === '<p></p>') {
            e.preventDefault();
            alert('Please enter some content for your post!');
            return false;
        }
        
        document.getElementById('post_content').value = quillContent;
        
        // Allow form to submit normally
        return true;
    });

    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('newImagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('newImagePreview').style.display = 'none';
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

    // Auto-fill SEO function
    function autoFillSeo() {
        const title = document.getElementById('title').value;
        const content = quill.getText();
        const excerpt = document.getElementById('excerpt').value;
        
        if (!title.trim()) {
            alert('Please enter a title first!');
            return;
        }
        
        if (!content.trim()) {
            alert('Please enter some content first!');
            return;
        }
        
        // Generate meta title (limit to 60 characters)
        let metaTitle = title;
        if (metaTitle.length > 60) {
            metaTitle = metaTitle.substring(0, 57) + '...';
        }
        document.getElementById('meta_title').value = metaTitle;
        
        // Generate meta description from content (limit to 160 characters)
        let metaDescription = content.substring(0, 160);
        if (metaDescription.length === 160) {
            const lastSpace = metaDescription.lastIndexOf(' ');
            if (lastSpace > 0) {
                metaDescription = metaDescription.substring(0, lastSpace);
            }
        }
        document.getElementById('meta_description').value = metaDescription;
        
        // Generate excerpt if empty
        if (!excerpt.trim()) {
            let generatedExcerpt = content.substring(0, 150);
            if (generatedExcerpt.length === 150) {
                const lastSpace = generatedExcerpt.lastIndexOf(' ');
                if (lastSpace > 0) {
                    generatedExcerpt = generatedExcerpt.substring(0, lastSpace);
                }
            }
            document.getElementById('excerpt').value = generatedExcerpt;
        }
        
        // Generate keywords from title and content
        const text = title + ' ' + content;
        const words = text.toLowerCase().replace(/[^\w\s]/g, '').split(' ');
        const stopWords = ['the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'can', 'this', 'that', 'these', 'those'];
        
        const keywords = words.filter(word => word.length > 3 && !stopWords.includes(word));
        const wordCount = {};
        keywords.forEach(word => {
            wordCount[word] = (wordCount[word] || 0) + 1;
        });
        
        const topKeywords = Object.keys(wordCount)
            .sort((a, b) => wordCount[b] - wordCount[a])
            .slice(0, 10);
        
        document.getElementById('meta_keywords').value = topKeywords.join(', ');
        
        // Generate OG title (limit to 95 characters)
        let ogTitle = title;
        if (ogTitle.length > 95) {
            ogTitle = ogTitle.substring(0, 92) + '...';
        }
        document.getElementById('og_title').value = ogTitle;
        
        // Generate OG description (limit to 200 characters)
        let ogDescription = content.substring(0, 200);
        if (ogDescription.length === 200) {
            const lastSpace = ogDescription.lastIndexOf(' ');
            if (lastSpace > 0) {
                ogDescription = ogDescription.substring(0, lastSpace);
            }
        }
        document.getElementById('og_description').value = ogDescription;
        
        // Update all character counters
        document.querySelectorAll('[id$="_counter"]').forEach(counter => {
            const fieldId = counter.id.replace('_counter', '');
            const field = document.getElementById(fieldId);
            if (field) {
                field.dispatchEvent(new Event('input'));
            }
        });
        
        alert('SEO fields have been auto-filled successfully!');
    }
</script>
@endsection
