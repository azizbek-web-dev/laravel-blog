@extends('layouts.app')

@section('title', 'DevMed.uz - Technology & Lifestyle Blog')

@section('content')
    {{-- Main Content --}}
    <main class="main">
        {{-- Hero Section - Featured post display --}}
        <section class="hero">
            <div class="hero-image">
                <img src="{{ asset($hero->image ?? 'img/hero-office.jpg') }}" alt="Modern office with technology" class="hero-bg">
                <div class="hero-overlay">
                    <div class="featured-post">
                        <div class="post-category">{{ $hero->category->name ?? 'No category' }}</div>
                        <h1 class="post-title">{{ $hero->title }}</h1>
                        <div class="post-meta">
                            <img src="{{ asset($hero->author->image ?? 'img/author-1.png') }}" alt="{{ $hero->author->name ?? 'No author' }}" class="post-avatar">
                            <span class="author-name">{{ $hero->author->name ?? 'No author' }}</span>
                            <span class="post-date">{{ $hero->created_at->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Advertisement Section (Top) - Revenue generation --}}
        <section class="ad-section">
            <div class="ad-container">
                <div class="ad-placeholder">
                    <h3>Advertisement</h3>
                    <p>You can place ads</p>
                    <span class="ad-dimensions">750x100</span>
                </div>
            </div>
        </section>

        {{-- Latest Posts Section - Recent content display --}}
        <section class="latest-posts">
            <div class="container">
                <h2 class="section-title">Latest Posts</h2>
                <div class="posts-grid">
                    {{-- Post cards loop - Display recent posts --}}
                    @foreach ($posts as $post)
                     <a href="{{ route('single-post', $post->slug) }}" class="post-card-link">
                    <article class="post-card">
                        <div class="post-image">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="post-content">
                            <div class="post-category">{{ $post->category->name ?? 'No category' }}</div>
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

                <div class="view-all-container">
                    <a href="{{ route('blog') }}" class="view-all-btn">View All Post</a>
                </div>
            </div>
        </section>

        {{-- Advertisement Section (Bottom) - Additional revenue --}}
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