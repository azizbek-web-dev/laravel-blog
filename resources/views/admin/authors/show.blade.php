@extends('admin.layouts.app')

@section('title', 'Author Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Author Details</h1>
            <div>
                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Author
                </a>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Authors
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <!-- Author Profile Card -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($author->image)
                        <img src="{{ asset($author->image) }}" alt="{{ $author->name }}" 
                             class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                             style="width: 150px; height: 150px;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    @endif
                </div>
                
                <h5 class="card-title">{{ $author->name }}</h5>
                <p class="text-muted">{{ $author->email }}</p>
                
                @if($author->bio)
                    <p class="card-text">{{ $author->bio }}</p>
                @else
                    <p class="text-muted">No bio available</p>
                @endif
                
                <div class="mt-3">
                    <span class="badge bg-primary">{{ $author->posts->count() }} Posts</span>
                    <span class="badge bg-info">{{ $author->created_at->format('M Y') }}</span>
                </div>
                
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar"></i> Joined {{ $author->created_at->format('F d, Y') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <!-- Author's Posts -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Posts by {{ $author->name }}</h6>
            </div>
            <div class="card-body">
                @if($author->posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($author->posts as $post)
                                <tr>
                                    <td>
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" 
                                             class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $post->title }}</strong>
                                        @if($post->excerpt)
                                            <br><small class="text-muted">{{ Str::limit($post->excerpt, 100) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $post->category->name }}</span>
                                    </td>
                                    <td>
                                        @if($post->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif($post->status === 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $post->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('single-post', $post->slug) }}" class="btn btn-sm btn-primary" title="View on Site" target="_blank">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No posts yet</h6>
                        <p class="text-muted">This author hasn't written any posts yet.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Posts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $author->posts->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Published</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $author->posts->where('status', 'published')->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Member Since</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $author->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection







