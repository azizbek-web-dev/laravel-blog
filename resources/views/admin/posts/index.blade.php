@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Manage Posts</h1>
            <div>
                <button type="button" class="btn btn-success me-2" onclick="bulkRegenerateSeo()">
                    <i class="fas fa-magic"></i> Bulk Regenerate SEO
                </button>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create New Post
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
            </div>
            <div class="card-body">
                @if($posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all-posts" class="form-check-input">
                                    </th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" class="form-check-input post-checkbox">
                                    </td>
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
                                        <div class="d-flex align-items-center">
                                            @if($post->author->image)
                                                <img src="{{ asset($post->author->image) }}" alt="{{ $post->author->name }}" 
                                                     class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                            @endif
                                            <span>{{ $post->author->name }}</span>
                                        </div>
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
                                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('single-post', $post->slug) }}" class="btn btn-sm btn-primary" title="View on Site" target="_blank">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.regenerate-seo', $post) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Regenerate SEO" onclick="return confirm('Regenerate SEO for this post?')">
                                                    <i class="fas fa-magic"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No posts found</h5>
                        <p class="text-muted">Start by creating your first blog post.</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Your First Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Bulk SEO Regeneration Form -->
<form id="bulk-seo-form" action="{{ route('admin.posts.bulk-regenerate-seo') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="post_ids" id="bulk-post-ids">
</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all posts checkbox
    const selectAllCheckbox = document.getElementById('select-all-posts');
    const postCheckboxes = document.querySelectorAll('.post-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        postCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update select all checkbox when individual checkboxes change
    postCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.post-checkbox:checked').length;
            const totalCount = postCheckboxes.length;
            
            if (checkedCount === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedCount === totalCount) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
            }
        });
    });
});

function bulkRegenerateSeo() {
    const checkedCheckboxes = document.querySelectorAll('.post-checkbox:checked');
    
    if (checkedCheckboxes.length === 0) {
        alert('Please select at least one post to regenerate SEO.');
        return;
    }
    
    if (!confirm(`Are you sure you want to regenerate SEO for ${checkedCheckboxes.length} selected posts?`)) {
        return;
    }
    
    const postIds = Array.from(checkedCheckboxes).map(cb => cb.value);
    document.getElementById('bulk-post-ids').value = JSON.stringify(postIds);
    document.getElementById('bulk-seo-form').submit();
}
</script>
@endpush
