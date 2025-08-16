@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">My Profile</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <!-- Profile Card -->
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
                @endif
                
                <div class="mt-3">
                    <span class="badge bg-primary">{{ $author->posts()->count() }} Posts</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <!-- Edit Profile Form -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $author->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $author->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="4">{{ old('bio', $author->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Tell us a bit about yourself (optional)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to keep current image. Recommended size: 300x300px</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">New Image Preview</label>
                        <div id="imagePreview" class="border rounded p-2 text-center" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Recent Posts -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">My Recent Posts</h6>
            </div>
            <div class="card-body">
                @php
                    $recentPosts = $author->posts()->latest()->take(5)->get();
                @endphp
                
                @if($recentPosts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentPosts as $post)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $post->title }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-tag"></i> {{ $post->category->name }}
                                </small>
                            </div>
                            <div>
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('single-post', $post->slug) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-primary">
                            View All Posts
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No posts yet</h6>
                        <p class="text-muted">Start writing your first blog post!</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Your First Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });
</script>
@endsection







