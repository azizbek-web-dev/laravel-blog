@extends('layouts.app')

@section('title', 'Blog - DevMed.uz Technology & Lifestyle Blog')

@section('content')
    {{-- Main Content --}}
    <main class="main">
        {{-- Page Title Section - Navigation and breadcrumbs --}}
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Blog</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Blog</span>
                </nav>
            </div>
        </section>

        {{-- Search Results Info - Display search and filter results --}}
        @if(request('search') || request('category'))
        <section class="search-results">
            <div class="container">
                <div class="search-info">
                    @if(request('search'))
                        <h3>Search Results for: "{{ request('search') }}"</h3>
                        <p>Found {{ $posts->total() }} result(s)</p>
                    @endif
                    @if(request('category'))
                        <h3>Category: {{ ucfirst(request('category')) }}</h3>
                        <p>Found {{ $posts->total() }} post(s) in this category</p>
                    @endif
                    <a href="{{ route('blog') }}" class="clear-search">Clear Search</a>
                </div>
            </div>
        </section>
        @endif

        {{-- Blog Posts Grid - Main content display --}}
        <section class="blog-posts">
            <div class="container">
                <div class="posts-grid blog-grid">
                    {{-- Post cards loop - Display blog posts --}}
                    @foreach ($posts as $post)
                     <a href="{{ route('single-post', $post->slug) }}" class="post-card-link">
                    <article class="post-card">
                        <div class="post-image">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                            <div class="post-category">{{ $post->category->name ?? 'No category' }}</div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <div class="post-meta">
                                <img src="{{ asset($post->author->image ?? 'img/author-1.png') }}" alt="{{ $post->author->name ?? 'No author' }}" class="post-avatar">
                                <span class="author-name">{{ $post->author->name ?? 'No author' }}</span>
                                <span class="post-date">{{ $post->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                    </article>
                    </a>
                    @endforeach
                    </div>

                    <div class="pagination-container">
                    <div class="pagination">
                        {{-- Avvalgi sahifa --}}
                        @if($posts->onFirstPage())
                            <span class="page-link disabled">Previous</span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" class="page-link">Previous</a>
                        @endif

                        {{-- Sahifa raqamlari --}}
                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                            @if($page == $posts->currentPage())
                                <span class="page-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Keyingi sahifa --}}
                        @if($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" class="page-link">Next</a>
                        @else
                            <span class="page-link disabled">Next</span>
                        @endif
                    </div>

                    </div>
                </div>
        </section>

        <!-- Advertisement Section -->
        <section class="ad-section">
            <div class="ad-container">
                <div class="ad-placeholder">
                    <h3>Advertisement</h3>
                    <p>You can place ads</p>
                    <span class="ad-dimensions">750x100</span>
                </div>
            </div>
        </section>
    </main>
@endsection