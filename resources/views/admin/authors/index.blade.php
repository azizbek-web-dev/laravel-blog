@extends('admin.layouts.app')

@section('title', 'Manage Authors')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Manage Authors</h1>
            <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Author
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">All Authors</h6>
            </div>
            <div class="card-body">
                @if($authors->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Posts Count</th>
                                    <th>Bio</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authors as $author)
                                <tr>
                                    <td>
                                        @if($author->image)
                                            <img src="{{ asset($author->image) }}" alt="{{ $author->name }}" 
                                                 class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $author->name }}</strong>
                                    </td>
                                    <td>{{ $author->email }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $author->posts_count }}</span>
                                    </td>
                                    <td>
                                        @if($author->bio)
                                            {{ Str::limit($author->bio, 100) }}
                                        @else
                                            <span class="text-muted">No bio</span>
                                        @endif
                                    </td>
                                    <td>{{ $author->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.authors.show', $author) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($author->posts_count == 0)
                                                <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this author?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled title="Cannot delete author with posts">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $authors->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No authors found</h5>
                        <p class="text-muted">Start by adding your first author.</p>
                        <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Your First Author
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection







