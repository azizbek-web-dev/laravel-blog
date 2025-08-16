@extends('layouts.app')

@section('title', 'Author - {{ $author->name }} - DevMed.uz')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Page Title Section -->
        <section class="page-title-section">
            <div class="container">
                <h1 class="page-title">Author Profile - {{ $author->name }}</h1>
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <span class="current">Author - Azizbek Hakimov</span>
                </nav>
            </div>
        </section>

        <!-- Author Bio Section -->
        <section class="author-bio">
            <div class="container">
                <div class="author-profile">
                    <div class="author-avatar">
                        <img src="{{ $author->image }}" alt="{{ $author->name }}">
                    </div>
                    <div class="author-info">
                        <h1 class="author-name">{{ $author->name }}</h1>
                        <p class="author-title">{{ $author->title ?? 'Collaborator & Editor' }}</p>
                        <p class="author-description">
                            {{ $author->bio }}
                        </p>
                        <div class="social-links">
                            <a href="{{ $author->facebook }}" class="social-link" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $author->twitter }}" class="social-link" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $author->instagram }}" class="social-link" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{ $author->youtube }}" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Post Section -->
        <section class="latest-posts">
            <div class="container">
                <h2 class="section-title">Latest Post</h2>
                <div class="posts-grid">
                    <!-- Post 1 -->
                     @foreach ($posts as $post)
                     <a href="{{ route('single-post', $post->slug) }}" class="post-card-link">
                    <article class="post-card">
                        <div class="post-image">
                            <img src="{{ $post->image }}" alt="Beach aerial view">
                        </div>
                        <div class="post-content">
                            <div class="post-category">{{ $post->category->name ?? 'No category' }}</div>
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <div class="post-meta">
                                <img src="{{ $post->author->image ?? 'img/author-1.png' }}" alt="{{ $post->author->name ?? 'No author' }}" class="post-avatar">
                                <span class="author-name">{{ $post->author->name ?? 'No author' }}</span>
                                <span class="post-date">{{ $post->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                    </article>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection