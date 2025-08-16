@extends('admin.layouts.app')

@section('title', 'Categories Management')

@section('styles')
<style>
    .category-card {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s;
        background: white;
    }
    
    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #6366f1;
    }
    
    .category-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .category-header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .category-header p {
        margin: 1rem 0 0 0;
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .category-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.5rem;
        border: 2px solid #e2e8f0;
    }
    
    .category-icon {
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }
    
    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        text-align: center;
        transition: all 0.3s;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #6366f1;
        margin-bottom: 0.5rem;
    }
    
    .stats-label {
        color: #6b7280;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .btn-create {
        background: #10b981;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .btn-create:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #d1d5db;
    }
</style>
@endsection

@section('content')
<!-- Header -->
<div class="category-header">
    <h1><i class="fas fa-tags"></i> Categories</h1>
    <p>Manage your blog categories and organize your content effectively</p>
</div>

<!-- Stats -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ $categories->total() }}</div>
            <div class="stats-label">Total Categories</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ $categories->where('posts_count', '>', 0)->count() }}</div>
            <div class="stats-label">Active Categories</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ $categories->sum('posts_count') }}</div>
            <div class="stats-label">Total Posts</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-number">{{ $categories->where('posts_count', 0)->count() }}</div>
            <div class="stats-label">Empty Categories</div>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">All Categories</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn-create">
                <i class="fas fa-plus"></i> Create New Category
            </a>
        </div>
    </div>
</div>

<!-- Categories Grid -->
@if($categories->count() > 0)
    <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="category-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($category->color)
                            <span class="category-color" style="background-color: {{ $category->color }}"></span>
                        @endif
                        @if($category->icon)
                            <i class="category-icon {{ $category->icon }}"></i>
                        @endif
                        <h5 class="card-title mb-0">{{ $category->name }}</h5>
                    </div>
                    
                    @if($category->description)
                        <p class="card-text text-muted">{{ Str::limit($category->description, 100) }}</p>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ $category->posts_count }} posts</span>
                        @if($category->slug)
                            <small class="text-muted">/{{ $category->slug }}</small>
                        @endif
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @if($category->posts_count == 0)
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete category with posts">
                                <i class="fas fa-lock"></i> Locked
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->appends(request()->query())->links() }}
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-tags"></i>
        <h4>No Categories Yet</h4>
        <p>Start organizing your content by creating your first category.</p>
        <a href="{{ route('admin.categories.create') }}" class="btn-create">
            <i class="fas fa-plus"></i> Create First Category
        </a>
    </div>
@endif
@endsection 