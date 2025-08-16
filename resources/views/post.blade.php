@extends('layouts.app')

@section('title', $post->title . ' - DevMed.uz')

@section('content')
    <!-- Main Content -->
    <main class="main">
        <!-- Single Post Content -->
        <section class="single-post">
            <div class="container">
                <!-- Post Header -->
                <div class="post-header">
                    <div class="post-category">{{ $post->category->name ?? 'No category' }}</div>
                    <h1 class="post-title">{{ $post->title }}</h1>
                    <div class="post-meta">
                        <span class="author-name">{{ $post->author->name ?? 'No author' }}</span>
                        <span class="post-date">{{ $post->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="post-content">
                    <div class="post-text">
                        @php
                            $decodedContent = html_entity_decode($post->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        @endphp
                        {!! $decodedContent !!}
                    </div>

                    <!-- Post Image -->
                    @if($post->image)
                    <div class="post-image-large">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}">
                    </div>
                    @endif
                </div>

                <!-- Related Posts Section -->
                <section class="related-posts">
                    <div class="container">
                        <h3 class="section-title">Related Posts</h3>
                        <div class="posts-grid">
                            @foreach($posts->take(3) as $relatedPost)
                                @if($relatedPost->id !== $post->id)
                                <a href="{{ route('single-post', $relatedPost->slug) }}" class="post-card-link">
                                    <article class="post-card">
                                        <div class="post-image">
                                            <img src="{{ $relatedPost->image }}" alt="{{ $relatedPost->title }}">
                                        </div>
                                        <div class="post-content">
                                            <div class="post-category">{{ $relatedPost->category->name ?? 'No category' }}</div>
                                            <h3 class="post-title">{{ $relatedPost->title }}</h3>
                                            <div class="post-meta">
                                                <img src="{{ $relatedPost->author->image ?? 'img/author-1.png' }}" alt="{{ $relatedPost->author->name ?? 'No author' }}" class="post-avatar">
                                                <span class="author-name">{{ $relatedPost->author->name ?? 'No author' }}</span>
                                                <span class="post-date">{{ $relatedPost->created_at->format('F d, Y') }}</span>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                                @endif
                            @endforeach
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
            </div>
        </section>
    </main>
@endsection