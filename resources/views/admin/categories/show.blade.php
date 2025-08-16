@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('styles')
<style>
    .category-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }
    
    .category-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    .category-color {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .info-card h5 {
        color: #374151;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
    }
    
    .info-card h5 i {
        margin-right: 0.5rem;
        color: #6366f1;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #374151;
    }
    
    .info-value {
        color: #6b7280;
        text-align: right;
        max-width: 60%;
    }
    
    .seo-preview {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 0.5rem;
    }
    
    .seo-preview h6 {
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    
    .seo-preview p {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        line-height: 1.4;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #6366f1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .btn-edit {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .btn-edit:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .btn-delete {
        background: #ef4444;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">
                <i class="fas fa-folder text-primary"></i> Category Details
            </h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
</div>

<!-- Category Header -->
<div class="category-header text-center">
    <div class="category-icon">
        <i class="{{ $category->icon ?? 'fas fa-folder' }}"></i>
    </div>
    <h1 class="h2 mb-3">{{ $category->name }}</h1>
    @if($category->color)
        <div class="d-flex align-items-center justify-content-center">
            <div class="category-color" style="background-color: {{ $category->color }};"></div>
            <span>{{ $category->color }}</span>
        </div>
    @endif
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $category->posts_count ?? 0 }}</div>
        <div class="stat-label">Posts</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $category->created_at->diffForHumans() }}</div>
        <div class="stat-label">Created</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $category->updated_at->diffForHumans() }}</div>
        <div class="stat-label">Last Updated</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Basic Information -->
        <div class="info-card">
            <h5><i class="fas fa-info-circle"></i> Basic Information</h5>
            
            <div class="info-item">
                <span class="info-label">Name:</span>
                <span class="info-value">{{ $category->name }}</span>
            </div>
            
            @if($category->description)
                <div class="info-item">
                    <span class="info-label">Description:</span>
                    <span class="info-value">{{ $category->description }}</span>
                </div>
            @endif
            
            @if($category->slug)
                <div class="info-item">
                    <span class="info-label">Slug:</span>
                    <span class="info-value">{{ $category->slug }}</span>
                </div>
            @endif
            
            @if($category->icon)
                <div class="info-item">
                    <span class="info-label">Icon:</span>
                    <span class="info-value">{{ $category->icon }}</span>
                </div>
            @endif
        </div>
        
        <!-- SEO Information -->
        <div class="info-card">
            <h5><i class="fas fa-search"></i> SEO Information</h5>
            
            @if($category->meta_title)
                <div class="info-item">
                    <span class="info-label">Meta Title:</span>
                    <span class="info-value">{{ $category->meta_title }}</span>
                </div>
            @endif
            
            @if($category->meta_description)
                <div class="info-item">
                    <span class="info-label">Meta Description:</span>
                    <span class="info-value">{{ $category->meta_description }}</span>
                </div>
            @endif
            
            @if($category->meta_keywords)
                <div class="info-item">
                    <span class="info-label">Meta Keywords:</span>
                    <span class="info-value">{{ $category->meta_keywords }}</span>
                </div>
            @endif
            
            @if($category->canonical_url)
                <div class="info-item">
                    <span class="info-label">Canonical URL:</span>
                    <span class="info-value">{{ $category->canonical_url }}</span>
                </div>
            @endif
        </div>
        
        <!-- Open Graph Information -->
        <div class="info-card">
            <h5><i class="fas fa-share-alt"></i> Social Media (Open Graph)</h5>
            
            @if($category->og_title)
                <div class="info-item">
                    <span class="info-label">OG Title:</span>
                    <span class="info-value">{{ $category->og_title }}</span>
                </div>
            @endif
            
            @if($category->og_description)
                <div class="info-item">
                    <span class="info-label">OG Description:</span>
                    <span class="info-value">{{ $category->og_description }}</span>
                </div>
            @endif
            
            @if($category->og_image)
                <div class="info-item">
                    <span class="info-label">OG Image:</span>
                    <span class="info-value">
                        <img src="{{ asset('storage/' . $category->og_image) }}" 
                             alt="OG Image" style="max-width: 100px; border-radius: 4px;">
                    </span>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- SEO Preview -->
        <div class="info-card">
            <h5><i class="fas fa-eye"></i> SEO Preview</h5>
            
            <div class="seo-preview">
                <h6>Google Search Result:</h6>
                <p style="color: #1a0dab; font-weight: 600; margin-bottom: 0.25rem;">
                    {{ $category->meta_title ?: $category->name }}
                </p>
                <p style="color: #006621; font-size: 0.75rem; margin-bottom: 0.5rem;">
                    {{ url('/categories/' . ($category->slug ?: 'category')) }}
                </p>
                <p style="color: #545454;">
                    {{ $category->meta_description ?: $category->description ?: 'No description available.' }}
                </p>
            </div>
            
            <div class="seo-preview mt-3">
                <h6>Social Media Share:</h6>
                <p style="font-weight: 600; margin-bottom: 0.25rem;">
                    {{ $category->og_title ?: $category->name }}
                </p>
                <p style="color: #545454;">
                    {{ $category->og_description ?: $category->description ?: 'No description available.' }}
                </p>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="info-card">
            <h5><i class="fas fa-cogs"></i> Quick Actions</h5>
            
            <div class="d-grid gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Category
                </a>
                
                @if($category->posts_count > 0)
                    <a href="#" class="btn btn-info">
                        <i class="fas fa-eye"></i> View Posts ({{ $category->posts_count }})
                    </a>
                @endif
                
                <button type="button" class="btn btn-danger" onclick="deleteCategory()">
                    <i class="fas fa-trash"></i> Delete Category
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="action-buttons">
    <a href="{{ route('admin.categories.edit', $category) }}" class="btn-edit">
        <i class="fas fa-edit"></i> Edit Category
    </a>
    
    <button type="button" class="btn-delete" onclick="deleteCategory()">
        <i class="fas fa-trash"></i> Delete Category
    </button>
</div>

<!-- Delete Form -->
<form id="deleteForm" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    function deleteCategory() {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection 