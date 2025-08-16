<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Admin panel for managing blog content, users, and settings">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'DevMed.uz') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <style>
        /*
        |--------------------------------------------------------------------------
        | Admin Panel Pagination Styles
        |--------------------------------------------------------------------------
        | Custom styling for pagination elements to match the admin panel design
        | and ensure consistent appearance across all admin pages.
        |
        */
        
        .pagination {
            justify-content: center;
            margin: 2rem 0;
        }
        
        .page-link {
            color: #6366f1;
            background-color: white;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .page-link:hover {
            color: white;
            background-color: #6366f1;
            border-color: #6366f1;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }
        
        .page-item.active .page-link {
            background-color: #6366f1;
            border-color: #6366f1;
            color: white;
        }
        
        .page-item.disabled .page-link {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }
        
        .page-item.disabled .page-link:hover {
            transform: none;
            box-shadow: none;
        }
        
        /* Pagination Icons */
        .pagination .page-link i {
            font-size: 0.875rem;
        }
        
        /* Responsive pagination */
        @media (max-width: 576px) {
            .pagination {
                flex-wrap: wrap;
                gap: 0.25rem;
            }
            
            .page-link {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="admin-sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-tachometer-alt"></i> Admin Panel</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fas fa-newspaper"></i> Posts
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.authors.index') }}">
                        <i class="fas fa-users"></i> Authors
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content" class="admin-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light admin-navbar">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ Auth::guard('author')->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    
    @yield('scripts')
</body>
</html>



