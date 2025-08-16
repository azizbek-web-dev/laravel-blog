@extends('admin.layouts.app')

@section('title', 'View Post')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">View Post: {{ $post->title }}</h1>
            <div>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Post
                </a>
                <a href="{{ route('single-post', $post->slug) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-eye"></i> View on Site
                </a>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Posts
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Post Content -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Post Content</h6>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" 
                         class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
                
                <h2 class="mb-3">{{ $post->title }}</h2>
                
                @if($post->excerpt)
                    <div class="alert alert-info">
                        <strong>Excerpt:</strong> {{ $post->excerpt }}
                    </div>
                @endif
                
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        @if($post->author->image)
                            <img src="{{ asset($post->author->image) }}" alt="{{ $post->author->name }}" 
                                 class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        @endif
                        <div>
                            <strong>{{ $post->author->name }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> {{ $post->created_at->format('F d, Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-tag"></i> {{ $post->category->name }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="post-content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Post Information -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Post Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-secondary">{{ $post->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        <td><span class="badge bg-info">{{ $post->category->name }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Author:</strong></td>
                        <td>{{ $post->author->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Slug:</strong></td>
                        <td><code>{{ $post->slug }}</code></td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $post->created_at->format('F d, Y \a\t g:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $post->updated_at->format('F d, Y \a\t g:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Post
                    </a>
                    <a href="{{ route('single-post', $post->slug) }}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View on Site
                    </a>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list"></i> All Posts
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Author Information -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Author Information</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($post->author->image)
                        <img src="{{ asset($post->author->image) }}" alt="{{ $post->author->name }}" 
                             class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x text-white"></i>
                        </div>
                    @endif
                </div>
                
                <h6>{{ $post->author->name }}</h6>
                <p class="text-muted small">{{ $post->author->email }}</p>
                
                @if($post->author->bio)
                    <p class="small">{{ Str::limit($post->author->bio, 100) }}</p>
                @endif
                
                <div class="mt-2">
                    <span class="badge bg-primary">{{ $post->author->posts()->count() }} Posts</span>
                </div>
                
                <div class="mt-2">
                    <a href="{{ route('admin.authors.show', $post->author) }}" class="btn btn-sm btn-outline-info">
                        <i class="fas fa-user"></i> View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Posts -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Other Posts by {{ $post->author->name }}</h6>
            </div>
            <div class="card-body">
                @php
                    $relatedPosts = $post->author->posts()->where('id', '!=', $post->id)->latest()->take(3)->get();
                @endphp
                
                @if($relatedPosts->count() > 0)
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <img src="{{ asset($relatedPost->image) }}" class="card-img-top" 
                                     alt="{{ $relatedPost->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($relatedPost->title, 50) }}</h6>
                                    <p class="card-text small text-muted">
                                        <i class="fas fa-calendar"></i> {{ $relatedPost->created_at->format('M d, Y') }}
                                    </p>
                                    <a href="{{ route('admin.posts.show', $relatedPost) }}" class="btn btn-sm btn-outline-primary">
                                        View Post
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">No other posts by this author.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .post-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }
    
    .post-content h1, .post-content h2, .post-content h3, 
    .post-content h4, .post-content h5, .post-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }
    
    .post-content p {
        margin-bottom: 1.5rem;
    }
    
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }
    
    .post-content blockquote {
        border-left: 4px solid var(--primary-color);
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #666;
    }
    
    .post-content ul, .post-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .post-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endsection






